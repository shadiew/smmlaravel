<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Service;
use App\Models\Category;
use App\Http\Traits\Notify;
use App\Models\ApiProvider;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use Notify;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }


    public function refillView()
    {
        $orders = Order::with(['users', 'service'])
            ->where('user_id', Auth::id())
            ->whereNotNull('refill_status')
            ->whereNotNull('refilled_at')
            ->latest()->paginate(config('basic.paginate'));

        return view('user.pages.order.refill-show', compact('orders'));
    }


    public function refillStatusSearch(Request $request, $name = 'awaiting')
    {
        $status = @$name;
        $orders = Order::with('service', 'users')
            ->where(['user_id' => Auth::id()])
            ->whereNotNull('refill_status')
            ->whereNotNull('refilled_at')
            ->when($status != -1, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->paginate(config('basic.paginate'));


        return view('user.pages.order.refill-show', compact('orders'));
    }


    public function refillSearch(Request $request)
    {
        $search = @$request->service;
        $orderId = @$request->order_id;
        $status = @$request->status;
        $dateSearch = @$request->date_time;

        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $orders = Order::with('service', 'users')
            ->where('user_id', Auth::id())
            ->whereNotNull('refill_status')
            ->whereNotNull('refilled_at')
            ->when($search, function ($query) use ($search) {
                return $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhereHas('service', function ($q) use ($search) {
                        return $q->where('service_title', 'LIKE', "%{$search}%");
                    });
            })
            ->when($orderId, function ($query) use ($orderId) {
                return $query->where('id', 'LIKE', "%{$orderId}%");
            })
            ->when($status != -1, function ($query) use ($status) {
                return $query->where('status', 'LIKE', "%{$status}%");
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->with('service', 'service.category', 'users')
            ->latest()
            ->paginate(config('basic.paginate'));

        return view('user.pages.order.refill-show', compact('orders'));
    }


    public function dripfeedView()
    {
        $orders = Order::with(['users', 'service'])->where('drip_feed', '!=', NULL)->latest()->where('user_id', Auth::id())->paginate(config('basic.paginate'));
        return view('user.pages.order.dripfeed-show', compact('orders'));
    }


    public function dripfeedSearch(Request $request)
    {
        $search = @$request->service;
        $orderId = @$request->order_id;
        $status = @$request->status;
        $dateSearch = @$request->date_time;

        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $orders = Order::with('service', 'users')->where('drip_feed', '!=', NULL)->where('user_id', Auth::id())
            ->when($search, function ($query) use ($search) {
                return $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhereHas('service', function ($q) use ($search) {
                        return $q->where('service_title', 'LIKE', "%{$search}%");
                    });
            })
            ->when($orderId, function ($query) use ($orderId) {
                return $query->where('id', 'LIKE', "%{$orderId}%");
            })
            ->when($status != -1, function ($query) use ($status) {
                return $query->where('status', 'LIKE', "%{$status}%");
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->with('service', 'service.category', 'users')
            ->latest()
            ->paginate(config('basic.paginate'));

        return view('user.pages.order.dripfeed-show', compact('orders'));
    }


    public function dripfeedStatusSearch(Request $request, $name = 'awaiting')
    {
        $status = @$name;
        $orders = Order::with('service', 'users')
            ->where('drip_feed', '!=', NULL)
            ->where(['user_id' => Auth::id()])
            ->when($status != -1, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->paginate(config('basic.paginate'));

        return view('user.pages.order.dripfeed-show', compact('orders'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['users', 'service'])->latest()->where('user_id', Auth::id())->paginate(config('basic.paginate'));
        return view('user.pages.order.show', compact('orders'));
    }

    public function search(Request $request)
    {
        $search = @$request->service;
        $orderId = @$request->order_id;
        $status = @$request->status;
        $dateSearch = @$request->date_time;

        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $orders = Order::where('user_id', Auth::id())
            ->when($search, function ($query) use ($search) {
                return $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhereHas('service', function ($q) use ($search) {
                        return $q->where('service_title', 'LIKE', "%{$search}%");
                    });
            })
            ->when($orderId, function ($query) use ($orderId) {
                return $query->where('id', 'LIKE', "%{$orderId}%");
            })
            ->when($status != -1, function ($query) use ($status) {
                return $query->where('status', 'LIKE', "%{$status}%");
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->with('service', 'service.category', 'users')
            ->latest()
            ->paginate(config('basic.paginate'));

        return view('user.pages.order.show', compact('orders'));
    }


    public function statusSearch(Request $request, $name = 'awaiting')
    {
        $status = @$name;
        $orders = Order::with('service', 'users')
            ->where(['user_id' => Auth::id()])
            ->when($status != -1, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->paginate(config('basic.paginate'));

        return view('user.pages.order.show', compact('orders'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $serviceId = @$request->serviceId;

        if (isset($serviceId)) {
            $data['selectService'] = Service::where('service_status', 1)->userRate()->with('category')->find($serviceId);
        } else {
            $data['selectService'] = null;
        }


        $data['categories'] = Category::with('service')
            ->whereHas('service', function ($query) {
                $query->where('service_status', 1)->userRate();
            })
            ->where('status', 1)
            ->get();

        return view('user.pages.order.add', $data, compact('serviceId'));
    }

    public function orderRefill(Request $request, $id)
    {
        $order = Order::with('service', 'service.provider')->findOrFail($id);
//        if ($order->status == 'completed' && $order->remains > 0 && optional($order->service)->refill == 1 && $order->refilled_at->lt(Carbon::now()->subHours(24)) && (!isset($order->refill_status) || $order->refill_status == 'completed' || $order->refill_status == 'partial' || $order->refill_status == 'canceled' || $order->refill_status == 'refunded')) {
        if ($order->status == 'completed' && $order->remains > 0 && optional($order->service)->refill == 1 && ($order->refilled_at == null || Carbon::parse($order->refilled_at) < Carbon::now()->subHours(24))  && (!isset($order->refill_status) || $order->refill_status == 'completed' || $order->refill_status == 'partial' || $order->refill_status == 'canceled' || $order->refill_status == 'refunded')) {
            if (optional($order->service)->is_refill_automatic == 1) {
                if (optional(optional($order->service)->provider)->status != 1) {
                    return back()->with('error', 'You are not eligible to send refill request.');
                }
                $refillResponse = Curl::to(optional(optional($order->service)->provider)->url)->withData(['key' => optional(optional($order->service)->provider)->api_key, 'action' => 'refill', 'order' => $order->api_order_id])->post();
                $refillResponse = json_decode($refillResponse);
                if (isset($refillResponse->refill)) {
                    $order->api_refill_id = $refillResponse->refill;
                    $order->refill_status = 'awaiting';
                    $order->refilled_at = now();
                    $order->save();
                } else {
                    return back()->with('error', 'You are not eligible to send refill request.');
                }
            } else {
                $order->refill_status = 'awaiting';
                $order->refilled_at = now();
                $order->save();
            }
        } else {
            return back()->with('error', 'You are not eligible to send refill request.');
        }

        return back()->with('success', 'Refill request has been submitted');
    }

    public function userservice(Request $request)
    {
        $serid = $request->ser_id;
        $service = Service::where('id', $serid)->userRate()->first();
        return $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = Purify::clean($request->all());
        $rules = [
            'category' => 'required|integer|min:1|not_in:0',
            'service' => 'required|integer|min:1|not_in:0',
            'link' => 'required|url',
            'quantity' => 'required|integer',
            'check' => 'required',
        ];
        if (!isset($request->drip_feed)) {
            $rules['runs'] = 'required|integer|not_in:0';
            $rules['interval'] = 'required|integer|not_in:0';
        }
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $service = Service::userRate()->findOrFail($request->service);

        $basic = (object)config('basic');

        $quantity = $request->quantity;

        if ($service->drip_feed == 1) {
            if (!isset($request->drip_feed)) {
                $rules['runs'] = 'required|integer|not_in:0';
                $rules['interval'] = 'required|integer|not_in:0';
                $validator = Validator::make($req, $rules);
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                $quantity = $request->quantity * $request->runs;
            }
        }
        if ($service->min_amount <= $quantity && $service->max_amount >= $quantity) {
            $userRate = ($service->user_rate) ?? $service->price;
            $price = round(($quantity * $userRate) / 1000, $basic->fraction_number);


            $user = Auth::user();
            if ($user->balance < $price) {
                return back()->with('error', "Insufficient balance in your wallet.")->withInput();
            }

            $order = new Order();
            $order->user_id = $user->id;
            $order->category_id = $req['category'];
            $order->service_id = $req['service'];
            $order->link = $req['link'];
            $order->quantity = $req['quantity'];
            $order->status = 'processing';
            $order->price = $price;
            $order->runs = isset($req['runs']) && !empty($req['runs']) ? $req['runs'] : null;
            $order->interval = isset($req['interval']) && !empty($req['interval']) ? $req['interval'] : null;

            if (isset($service->api_provider_id)) {
                $apiproviderdata = ApiProvider::find($service->api_provider_id);
                $postData = [
                    'key' => $apiproviderdata['api_key'],
                    'action' => 'add',
                    'service' => $service->api_service_id,
                    'link' => $req['link'],
                    'quantity' => $req['quantity']
                ];

                if (isset($req['runs']))
                    $postData['runs'] = $req['runs'];

                if (isset($req['interval']))
                    $postData['interval'] = $req['interval'];

                $apiservicedata = Curl::to($apiproviderdata['url'])->withData($postData)->post();
                $apidata = json_decode($apiservicedata);
                if (isset($apidata->order)) {
                    $order->status_description = "order: {$apidata->order}";
                    $order->api_order_id = $apidata->order;
                } else {
                    $order->status_description = "error: {$apidata->error}";
                }
            }

            $order->save();
            $user->balance -= $price;
            $user->save();

            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->trx_type = '-';
            $transaction->amount = $price;
            $transaction->remarks = 'Place order';
            $transaction->trx_id = strRandom();
            $transaction->charge = 0;
            $transaction->save();


            $msg = [
                'username' => $user->username,
                'price' => $price,
                'currency' => $basic->currency
            ];
            $action = [
                "link" => route('admin.order.edit', $order->id),
                "icon" => "fas fa-cart-plus text-white"
            ];
            $this->adminPushNotification('ORDER_CREATE', $msg, $action);


            $this->sendMailSms($user, 'ORDER_CONFIRM', [
                'order_id' => $order->id,
                'order_at' => $order->created_at,
                'service' => optional($order->service)->service_title,
                'status' => $order->status,
                'paid_amount' => $price,
                'remaining_balance' => $user->balance,
                'currency' => $basic->currency,
                'transaction' => $transaction->trx_id,
            ]);

            return back()->with('success', 'Your order has been submitted');

        } else {
            return back()->with('error', "Order quantity should be minimum {$service->min_amount} and maximum {$service->max_amount}")->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order = Order::find($order->id);
        return view('user.pages.order.edit', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order = Order::find($order->id);
        $order->delete();
        return back()->with('success', 'Successfully Deleted');
    }

    public function statusChange(Request $request)
    {
        $req = Purify::clean($request->all());
        $order = Order::find($request->id);
        $order->status = $req['statusChange'];
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

        return back()->with('success', 'Successfully Updated');
    }

    public function getservice(Request $request)
    {
        $service = Service::where('service_status')->where('service_title', 'LIKE', "%{$request->service}%")->get()->pluck('service_title');
        return response()->json($service);
    }

    public function massOrder()
    {
        return view('user.pages.order.add_mass_order');
    }


    public function masOrderStore(Request $request)
    {
        $req = Purify::clean($request->all());
        $rules = [
            'mass_order' => 'required',
        ];
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $orders = explode("\r\n", $req['mass_order']);

        $basic = (object)config('basic');

        foreach ($orders as $order) {
            $singleOrder = explode("|", trim($order));
            if (count($singleOrder) != 3) {
                continue;
            }

            if (fmod($singleOrder[0], 1) != 0 || fmod($singleOrder[1], 1) != 0) {
                continue;
            }

            $serviceid = Service::userRate()->find($singleOrder[0]);
            if ($serviceid) {
                $specificRate = floatval(($serviceid->user_rate) ?? $serviceid->price);

                $orderM = new Order();
                $orderM->service_id = $singleOrder[0];
                $orderM->category_id = $serviceid->category_id;
                $orderM->quantity = $singleOrder[1];
                $orderM->link = $singleOrder[2];

                $price = round(((floatval($singleOrder[1]) * $specificRate) / 1000), $basic->fraction_number);
                $orderM->price = $price;
                $user = $this->user;
                $orderM->user_id = $user->id;

                if ($serviceid->service_status == 1) {
                    if (isset($singleOrder[1]) && !empty($singleOrder[1]) && $singleOrder[1] % 1 == 0) {
                        if ($serviceid->min_amount <= $singleOrder[1] && $serviceid->max_amount >= $singleOrder[1]) {
                            if (isset($singleOrder[2]) && !empty($singleOrder[2])) {
                                if ($user->balance >= $orderM->price) {
                                    $user->balance -= $orderM->price;
                                    $user->save();

                                    $orderM->status = 'pending';

                                    if (isset($serviceid->api_provider_id)) {
                                        $apiproviderdata = ApiProvider::find($serviceid->api_provider_id);
                                        if ($apiproviderdata) {
                                            $apiservicedata = Curl::to($singleOrder[2])->withData(['key' => $apiproviderdata['api_key'], 'action' => 'add', 'service' => $serviceid->api_service_id, 'link' => $singleOrder[2], 'quantity' => $singleOrder[1]])->post();
                                            $apidata = json_decode($apiservicedata);
                                            if (isset($apidata->order)) {
                                                $orderM->status_description = "order: {$apidata->order}";
                                                $orderM->api_order_id = $apidata->order;
                                                $orderM->status = 'progress';
                                            } else {
                                                $orderM->status_description = "error: {$apidata->error}";
                                            }
                                        }
                                    }

                                    $orderM->save();

                                    $transaction = new Transaction();
                                    $transaction->user_id = $user->id;
                                    $transaction->trx_type = '-';
                                    $transaction->amount = $orderM->price;
                                    $transaction->charge = 0;
                                    $transaction->remarks = 'Place order';
                                    $transaction->trx_id = strRandom();
                                    $transaction->save();

                                    $this->sendMailSms($user, 'ORDER_CONFIRM', [
                                        'order_id' => $orderM->id,
                                        'order_at' => $orderM->created_at,
                                        'service' => optional($orderM->service)->service_title,
                                        'status' => $orderM->status,
                                        'paid_amount' => $orderM->price,
                                        'remaining_balance' => $user->balance,
                                        'currency' => $basic->currency,
                                        'transaction' => $transaction->trx_id,
                                    ]);

                                    $msg = ['username' => $user->username, 'price' => $orderM->price, 'currency' => $basic->currency];
                                    $action = [
                                        "link" => route('admin.order.edit', $orderM->id),
                                        "icon" => "fas fa-cart-plus text-white"
                                    ];
                                    $this->adminPushNotification('ORDER_CREATE', $msg, $action);
                                } else {
                                    $orderM->reason = "Insufficient balance in your wallet";
                                    $orderM->status = 'canceled';
                                }
                            } else {
                                $orderM->reason = "Link is Invalid";
                                $orderM->status = 'canceled';
                            }
                        } else {
                            $orderM->reason = "Order quantity should be minimum {$serviceid->min_amount} and maximum {$serviceid->max_amount}";
                            $orderM->status = 'canceled';
                        }
                    } else {
                        $orderM->reason = "Invalid Quantity";
                        $orderM->status = 'canceled';
                    }
                } else {
                    $orderM->reason = "Service not available";
                    $orderM->status = 'canceled';
                }
                $orderM->save();
            }
        }
        return back()->with('success', 'Successfully Added');
    }

}
