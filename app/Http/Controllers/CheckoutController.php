<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address; 


class CheckoutController extends Controller
{
public function saveAddresses(Request $request)
{
    $user = Auth::user();

    // Check if billing data exists (you can check first_name as main indicator)
    if ($request->filled('billing_firstname')) {
        // Save Billing
        $billing = $user->addresses()->updateOrCreate(
            ['is_billing' => true],
            [
                'first_name'   => $request->billing_firstname,
                'last_name'    => $request->billing_lastname,
                'email'        => $request->billing_email,
                'telephone'    => $request->billing_telephone,
                'fax'          => $request->billing_fax,
                'company'      => $request->billing_company,
                'address1'     => $request->billing_address1,
                'address2'     => $request->billing_address2,
                'city'         => $request->billing_city,
                'postcode'     => $request->billing_postcode,
                'country'      => $request->billing_country,
                'region_state' => $request->billing_region_state,
            ]
        );
    } else {
        $billing = null; // Billing not saved
    }

    // Save Delivery (always save delivery)
    $delivery = $user->addresses()->updateOrCreate(
        ['is_delivery' => true],
        [
            'first_name'   => $request->delivery_firstname,
            'last_name'    => $request->delivery_lastname,
            'email'        => $request->delivery_email,
            'telephone'    => $request->delivery_telephone,
            'fax'          => $request->delivery_fax,
            'company'      => $request->delivery_company,
            'address1'     => $request->delivery_address1,
            'address2'     => $request->delivery_address2,
            'city'         => $request->delivery_city,
            'postcode'     => $request->delivery_postcode,
            'country'      => $request->delivery_country,
            'region_state' => $request->delivery_region_state,
        ]
    );

    // Return saved data
    return response()->json([
        'success'  => true,
        'billing'  => $billing,
        'delivery' => $delivery
    ]);
}



    public function getDeliveryAddress()
{
    $user = auth()->user();
    $delivery = $user->addresses()->where('is_billing', false)->first();

    if ($delivery) {
        return response()->json([
            'success' => true,
            'delivery' => $delivery
        ]);
    }

    return response()->json(['success' => false]);
}
}

