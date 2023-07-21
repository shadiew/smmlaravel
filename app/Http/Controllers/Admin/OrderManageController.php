<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Models\Category;
use App\Models\Order;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class OrderManageController extends Controller
{
    use Notify;
    public function userOrder($id)
    {
        $user = User::with('order', 'order.service', 'order.service.category')->findOrFail($id);
        $userid = $user->id;
        return view('admin.pages.users.show-order-user', compact('user', 'userid'));
    }

    public function userOrderSearch(Request $request)
    {
        $search = @$request->search;
        $userid = @$request->user_id;
        $status = @$request->status;
        $dateSearch = @$request->date_order;

        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $orders = Order::when($userid, function ($query) use ($userid) {
            return $query->where('user_id', $userid);
        })
            ->when($search, function ($query) use ($search) {
                return $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhereHas('service', function ($q) use ($search) {
                        return $q->where('service_title', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('users', function ($q) use ($search) {
                        return $q->where('email', 'LIKE', "%{$search}%")
                            ->orWhere('username', 'LIKE', "%{$search}%");
                    });
            })
            ->when($status != -1, function ($query) use ($status) {
                return $query->where('status', 'LIKE', "%{$status}%");
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->with('service', 'service.category', 'users')
            ->paginate(config('basic.paginate'));

        return view('admin.pages.users.userordersearch', compact('orders', 'userid'));
    }


    public function userServiceEdit($id)
    {
        $order = Order::with('service', 'service.category')->find($id);
        $categories = Category::with('service')->has('service')->get();
        $service = Service::all();
        return view('admin.pages.users.edit-order-service', compact('order', 'categories', 'service'));
    }

    public function usersOrderChangeStatus(Request $request)
    {
        $status = $request->status;
        if ($request->strIds == null) {
            session()->flash('error', "You have not selected any order.");
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);

            if (count($ids) > 0) {
                $logs = Order::whereIn('id', $ids)->with('user')->get()->map(function ($order) use($status){
                    $order->status = $status;
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

                    $msg = [
                        'order_id' => $order->id,
                        'status' => $status
                    ];
                    $action = [
                        "link" => '#',
                        "icon" => "fas fa-cart-plus text-white"
                    ];
                    @$this->userPushNotification($order->user, 'ORDER_STATUS_CHANGED', $msg, $action);
                    return $order;

                });

                return $logs;
            }
            session()->flash('success', 'Order has been updated');
            return response()->json(['success' => 1]);
        }
    }

    public function refillStatusChange(Request $request)
    {
        $status = $request->refill_status;
        if ($request->strIds == null) {
            session()->flash('error', "You have not selected any order.");
            return back();
        } else {
            $ids = explode(",", $request->strIds);

            if (count($ids) > 0) {
                $logs = Order::whereIn('id', $ids)->whereNotNull('refilled_at')->with('user')->get()->map(function ($order) use($status){
                    $order->refill_status = $status;
                    $order->save();

                    $msg = [
                        'order_id' => $order->id,
                        'status' => $status
                    ];
                    $action = [
                        "link" => '#',
                        "icon" => "fas fa-cart-plus text-white"
                    ];
                    @$this->userPushNotification($order->users, 'REFILL_STATUS_CHANGED', $msg, $action);
                    return $order;

                });

                return $logs;
            }
            session()->flash('success', 'Refill status has been updated');
            return response()->json(['success' => 1]);
        }
    }

    public function awaitingMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You do not select User Id!!');
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                $order->update([
                    'status' => 'awaiting',
                ]);
            }
            session()->flash('success', 'Updated Successfully!!');
            return response()->json(['success' => 1]);
        }
    }

    public function pendingMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You do not select User Id!!');
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                $order->update([
                    'status' => 'pending',
                ]);
            }
            session()->flash('success', 'Updated Successfully!!');
            return response()->json(['success' => 1]);
        }
    }

    public function processingMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You do not select User Id!!');
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                $order->update([
                    'status' => 'processing',
                ]);
            }
            session()->flash('success', 'Updated Successfully!!');
            return response()->json(['success' => 1]);
        }
    }

    public function inProgressMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You do not select User Id!!');
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                $order->update([
                    'status' => 'progress',
                ]);
            }
            session()->flash('success', 'Updated Successfully!!');
            return response()->json(['success' => 1]);
        }
    }

    public function completedMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You do not select User Id!!');
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                $order->update([
                    'status' => 'completed',
                ]);
            }
            session()->flash('success', 'Updated Successfully!!');
            return response()->json(['success' => 1]);
        }
    }

    public function partialMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You do not select User Id!!');
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                $order->update([
                    'status' => 'partial',
                ]);
            }
            session()->flash('success', 'Updated Successfully!!');
            return response()->json(['success' => 1]);
        }
    }

    public function cancelledMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You do not select User Id!!');
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $orders = Order::whereIn('id', $ids);
                $orders->update([
                    'status' => 'canceled',
                ]);
            }
            session()->flash('success', 'Updated Successfully!!');
            return response()->json(['success' => 1]);
        }
    }

    public function refundedMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You do not select User Id!!');
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                $order->update([
                    'status' => 'refunded',
                ]);
            }
            session()->flash('success', 'Updated Successfully!!');
            return response()->json(['success' => 1]);
        }
    }



    public function getUsername(Request $request)
    {
        $user = User::where('username', 'LIKE', "%{$request->data}%")->get()->pluck('name');
        return response()->json($user);
    }
}
