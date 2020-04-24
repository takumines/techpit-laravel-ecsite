<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartItem;
use Illuminate\Support\Facades\Auth;
use App\Mail\Buy;
use Illuminate\Support\Facades\Mail;

class BuyController extends Controller
{
    public function index()
    {
        $cartitems = CartItem::where('user_id', Auth::id())->get();
        $subtotal = 0;
        foreach ($cartitems as $cartitem) {
            $subtotal += $cartitem->item->amount * $cartitem->quantity;
        }

        return view('buy.index', ['cartitems' => $cartitems, 'subtotal' => $subtotal]);
    }

    public function store(Request $request)
    {
        if ($request->has('post')) {
            $cartitems = CartItem::where('user_id', Auth::id())->get();
            $subtotal = 0;
            foreach ($cartitems as $cartitem) {
                $subtotal += $cartitem->item->amount * $cartitem->quantity;
            }
            Mail::to(Auth::user()->email)->send(new Buy($cartitems, $subtotal));
            CartItem::where('user_id', Auth::id())->delete();
            return view('buy/complete');
        }
        $request->flash();
        return $this->index();
    }
}
