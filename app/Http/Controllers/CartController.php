<?php

namespace App\Http\Controllers;

use App\Interfaces\Cart\ICartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartService;
    public function __construct(ICartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function add(Request $request)
    {
        $result = $this->cartService->add($request);
        if ($result == false) {
            return redirect()->back();
        }
        return redirect('/carts');
    }

    public function show()
    {
        $products = $this->cartService->getCartItems();
        return view('cart.list', [
            'title' => 'Giỏ hàng',
            'products' => $products,
            'carts' => Session::get('carts'),
            'breadcrumbs' => 'Giỏ hàng',
        ]);
//        if($this->cartService->getItemCount() > 0) {
//            return view('cart.list', [
//                'title' => 'Giỏ hàng',
//                'products' => $products,
//                'carts' => Session::get('carts'),
//                'breadcrumbs' => 'Giỏ hàng',
//            ]);
//        }else{
//            return redirect()->route("home");
//        }

    }

    public function update(Request $request)
    {
        $result = $this->cartService->update($request);
        if ($result == false) {
            return redirect()->back();
        }
        return redirect('/carts');
    }

    public function remove($cartItemId = 0)
    {
        $this->cartService->remove($cartItemId);
        return redirect('/carts');
    }
}
