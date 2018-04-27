<?php

namespace App\Http\Controllers\Home;

use App\CartOrder;
use App\Http\Controllers\Controller;
use App\OrderCartProduct;

class HomeCartController extends Controller
{

    /**
     * Show Admin home cart table and cart-control panel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cart()
    {
        $cartOrders = new CartOrder;
        $orderProdCart = new OrderCartProduct;
        if ($cartOrders) {

            return view('home.cart.cart', [
                'cartOrders' => $cartOrders->getCartOrders(),
                'cartColumnName' => $cartOrders->getCartColumnName(),
                'orderProduct' => $orderProdCart->getOrderProductCarts(),
            ]);
        }

        return view('home.cart.cart');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function deleteOrder($id)
    {
        $deletedOrder = new CartOrder();
        $deletedOrder->where('id', $id)->delete();
        if ($deletedOrder) {

            return redirect()->route('home_cart')
                ->with('messageSuccess', 'This Order deleted');
        }
        return redirect()->route('home_cart')
            ->with('messageWarning', 'Warning');
    }

}
