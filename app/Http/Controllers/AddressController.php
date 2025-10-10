<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
   public function storeBilling(Request $request)
{
    Address::updateOrCreate(
        [
            'user_id' => auth()->id(),
            'is_billing' => true
        ],
        $request->all() + ['user_id' => auth()->id(), 'is_billing' => true]
    );

    return redirect()->back()->with('success', 'Billing address saved!');
}

public function storeDelivery(Request $request)
{
    Address::updateOrCreate(
        [
            'user_id' => auth()->id(),
            'is_delivery' => true
        ],
        $request->all() + ['user_id' => auth()->id(), 'is_delivery' => true]
    );

    return redirect()->back()->with('success', 'Delivery address saved!');
}

}
