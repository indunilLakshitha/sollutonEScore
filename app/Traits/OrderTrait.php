<?php

namespace App\Traits;

use App\Jobs\SendMailJob;
use App\Jobs\SendSmsJob;
use App\Models\Marketplace\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait OrderTrait
{
    public function addToOrder(): Order
    {
        $order = new Order();
        if (!empty($user_id)) {
            $order->user_id = trim($user_id);
        }
        $order->order_number = mt_rand(100000000, 999999999);
        $order->first_name = trim($request->first_name);
        $order->last_name = trim($request->last_name);
        $order->company_name = trim($request->company_name);
        $order->country_id = trim($request->country);
        $order->state_id = trim($request->state);
        $order->city_id = trim($request->city);
        $order->postal_code = trim($request->postal_code);
        $order->address_one = trim($request->address_line_one);
        $order->address_two = trim($request->address_line_two);
        $order->phone = trim($request->phone_number);
        $order->email = trim($request->email);
        $order->note = trim($request->note);
        $order->discount_amount = trim($discount_amount);
        $order->discount_id = $request->discount_code ? $getDiscount->id : null;
        $order->deliver_charge_id = trim($request->deliver);
        $order->deliver_charge_amount = trim($shipping_amount);
        $order->total_amount = trim($total_amount);
        $order->payment_method = trim($request->payment_method);

        $order->save();
        return $order;
    }

    public function sendStatusChangeSms(Order $order)
    {

        $user = User::find($order->user_id);
        $details['user_id'] = $user->id;
        $details['type'] = 'ORDER_STATUS_CHANGED';
        $details['mobileNo'] = $order->phone;
        $details['msg'] = $this->getStatusChangeSms(
            status: $this->getStatus($order->status),
            orderNumber: $order->order_number,
            firstName: trim((string) ($order->first_name ?? '')),
        );

        dispatch(new SendSmsJob($details));
    }

    public function sendStatusChangeEmail(Order $order)
    {

        $details['type'] = 'ORDER_STATUS_CHANGED';
        $details['email'] = $order->email;
        $details['status'] = $this->getStatus($order->status);
        $details['time'] = Carbon::now();
        $details['name'] = trim((string) ($order->first_name ?? '')) ?: 'Customer';
        $details['url'] = env('APP_URL') . '/dashboard/order/history/marketplace/' . $order->id;

        dispatch(new SendMailJob($details));
    }


    public function getStatus($status)
    {
        foreach (Order::STATUS_LIST as $st) {
            if ($st['value'] == $status) {
                return $st['name'];
            }
        }
    }
}
