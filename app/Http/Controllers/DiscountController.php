<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscountCoupon;
use Carbon\Carbon;
use Inertia\Inertia;
class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        inertia('Discount/Index', DiscountCoupon::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $discountCoupon = DiscountCoupon::where('coupon', $request->coupon)->where('validity', '>', Carbon::now())->first();

if ($discountCoupon) {

    $discount = $discountCoupon->discount;
    $discountType = $discountCoupon->type;
    return response()->json(["discount"=>$discount, "type"=>$discountType]);

} else {
    $discount = 0;
    return response()->json(["discount"=>$discount]);

}

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
