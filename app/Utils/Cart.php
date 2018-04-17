<?php

namespace App;


class Cart
{

    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    /**
     * Cart constructor.
     * @param $oldCart
     */
    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    /**
     * @param $cart
     * @param $id
     */
    public static function deleteItems($cart, $id)
    {
        if (isset($cart->items[$id])) {

            $cart->totalPrice -= $cart->items[$id]['price'];
            $cart->totalQty -= $cart->items[$id]['quantity'];
            unset($cart->items[$id]);
        }

    }

    /**
     * @param $cart
     * @param $id
     */
    public static function changeCartItem($cart, $id, $change)
    {
        if (isset($cart->items[$id]) && $change == true) {

            $cart->totalQty ++;
            $cart->items[$id]['quantity'] ++;
            $cart->items[$id]['price'] += $cart->items[$id]['item']['price'];
            $cart->totalPrice += $cart->items[$id]['item']['price'];

        } else if ($cart->items[$id]['quantity'] >= 2 && $change == false) {

            $cart->totalQty --;
            $cart->items[$id]['quantity'] --;
            $cart->items[$id]['price'] -= $cart->items[$id]['item']['price'];
            $cart->totalPrice -= $cart->items[$id]['item']['price'];
        }
    }

    /**
     * @param $item
     * @param $id
     */
    public function add($item, $id)
    {
        $storedItem = ['quantity' => 0, 'price' => $item->price, 'item' => $item];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['quantity'] ++;
        $storedItem['price'] = $item->price * $storedItem['quantity'];
        $this->items[$id] = $storedItem;
        $this->totalQty ++;
        $this->totalPrice += $item->price;

    }


}
