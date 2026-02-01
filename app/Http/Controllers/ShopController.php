<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop');
    }

   public function store(Request $r)
{
    Transaction::create([
        'name' => $r->name,
        'phone' => $r->phone,
        'address' => $r->address,
        'product' => $r->product,
        'duration' => $r->duration,
        'qty' => $r->qty,
        'total' => $r->total,
        'status' => 'pending'
    ]);

    return response()->json(['ok'=>true]);
}

}
