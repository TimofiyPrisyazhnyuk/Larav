<?php

namespace App\Http\Controllers\Shop;

use App\Cart;
use App\CartOrder;
use App\Http\Controllers\Controller;
use App\OrderCartProduct;
use App\Product;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{

    /**
     * @var array
     */
    protected $rules = [
        'name' => 'required|max:100|min:3',
        'email' => 'required|email',
        'phone' => 'required|numeric|min:10',
        'city' => 'required|string|max:50',
        'deliveryMethod' => 'required',
    ];

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Cart()
    {
        if (!Session::has('cart')) {
            return view('shop.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('shop.cart', [
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice,
            'totalQty' => $cart->totalQty,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function cartAdd(Request $request, $id)
    {
        $products = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($products, $products->id);

        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cartDelete(Request $request, $id)
    {
        if (Session::has('cart')) {
            $cart = $request->session()->get('cart');
            Cart::deleteItems($cart, $id);
            if ($cart->totalPrice == 0) {
                $request->session()->forget('cart');
            }
        }
        return redirect()->route('cart');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function plusItemCart(Request $request, $id)
    {
        if (Session::has('cart')) {
            $cart = $request->session()->get('cart');
            $change = true;
            Cart::changeCartItem($cart, $id, $change);
        }
        return redirect()->route('cart');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function minusItemCart(Request $request, $id)
    {
        if (Session::has('cart')) {
            $cart = $request->session()->get('cart');
            $change = false;
            Cart::changeCartItem($cart, $id, $change);
        }
        return redirect()->route('cart');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveOrderProducts(Request $request)
    {
        if (Session::has('cart')) {
            $data = $request->all();
            $cart = $request->session()->get('cart');
            $validate = $this->validate($request, $this->rules);

            if ($validate && $this->saveOrder($data, $cart)) {
                $request->session()->forget('cart');

                return redirect()->route('cart')->with(
                    'messageSuccess',
                    'Спасибо, ваш заказ принят!Наш менеджер свяжется с Вами');
            }
        }
        return redirect()->route('cart');
    }

    /**
     * @param $data
     * @param $cart
     * @return bool
     */
    public function saveOrder($data, $cart)
    {
        $saveCart = CartOrder::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phoneNumber' => $data['phone'],
            'deliveryMethod' => $data['deliveryMethod'],
            'city' => $data['city'],
            'totalQty' => $cart->totalQty,
            'totalPrice' => $cart->totalPrice,
        ]);
        $saveOrderProduct = OrderCartProduct::saveOrderCartProduct($cart, $saveCart->id);

        return ($saveOrderProduct != false) ? true : false;

    }

}
