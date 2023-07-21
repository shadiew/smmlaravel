<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Console\Command;

class UpdateProviderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-provider:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Provider Status for Order';

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
     * @return int
     */
    public function handle()
    {


        $orders = Order::with(['service', 'service.provider', 'user'])->whereNotIn('status', ['completed', 'refunded', 'canceled'])->whereHas('service', function ($query) {
            $query->whereNotNull('api_provider_id')->orWhere('api_provider_id', '!=', 0);
        })->get();

        foreach ($orders as $order) {
            $service = $order->service;
            if (isset($service->api_provider_id)) {
                $apiproviderdata = $service->provider;
                $apiservicedata = Curl::to($apiproviderdata['url'])->withData(['key' => $apiproviderdata['api_key'], 'action' => 'status', 'order' => $order->api_order_id])->post();
                $apidata = json_decode($apiservicedata);
                if (isset($apidata->status)) {
                    $order->status = (strtolower($apidata->status) == 'in progress') ? 'progress' : strtolower($apidata->status);
                    $order->start_counter = @$apidata->start_count;
                    $order->remains = @$apidata->remains;
                }

                if (isset($apidata->error)) {
                    $order->status_description = "error: {" . @$apidata->error . "}";
                }
                $order->save();


                if ($order->status == 'refunded' && $order->remains != 0) {
                    $perOrder = $order->price / $order->quantity;
                    $getBackAmo = $order->remains * $perOrder;

                    $user = $order->user;
                    $user->balance += $getBackAmo;
                    $user->save();

                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->trx_type = '+';
                    $transaction->amount = $getBackAmo;
                    $transaction->remarks = 'Refunded order on #'.$order->id;
                    $transaction->trx_id = strRandom();
                    $transaction->charge = 0;
                    $transaction->save();

                }

                if ($order->status == 'canceled') {
                    $getBackAmo = $order->price;

                    $user = $order->user;
                    $user->balance += $getBackAmo;
                    $user->save();

                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->trx_type = '+';
                    $transaction->amount = $getBackAmo;
                    $transaction->remarks = 'Canceled order on #'.$order->id;
                    $transaction->trx_id = strRandom();
                    $transaction->charge = 0;
                    $transaction->save();

                }


            }
        };

        $this->info('status');
    }
}
