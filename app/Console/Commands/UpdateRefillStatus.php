<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Ixudra\Curl\Facades\Curl;

class UpdateRefillStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-refill:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Provider Refill Status for Order';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $orders = Order::with(['service', 'service.provider'])
            ->whereNotIn('status', ['completed', 'refunded', 'canceled'])
            ->whereNotIn('refill_status', ['completed', 'refunded', 'canceled'])
            ->whereNotNull('refilled_at')
            ->whereNotNull('api_refill_id')
            ->whereHas('service', function ($query) {
                $query->whereNotNull('api_provider_id')->orWhere('api_provider_id', '!=', 0);
            })
            ->get();

        foreach ($orders as $order) {
            $service = $order->service;
            if (isset($service->api_provider_id)) {
                $apiproviderdata = $service->provider;
                $apiservicedata = Curl::to($apiproviderdata['url'])->withData(['key' => $apiproviderdata['api_key'], 'action' => 'refill_status', 'refill' => $order->api_refill_id])->post();
                $apidata = json_decode($apiservicedata);
                if (isset($apidata->status)) {
                    $order->status = strtolower($apidata->status);
                    $order->save();
                }
            }
        };

        $this->info('Refill status');
    }
}
