<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_cart_product extends Model
{

    protected $table = 'order_cart_product';

    protected $fillable = [
        'cart_id', 'product_id', 'price', 'quantity',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartOrders()
    {
        return $this->hasMany('App\CartOrders', 'cart_id');
    }

    /**
     * @param $cart
     * @param $cartId
     * @return bool
     */
    public static function saveOrderCartProduct($cart, $cartId)
    {
        if (isset($cartId)) {
            foreach ($cart->items as $item) {
                Order_cart_product::create([
                    'cart_id' => $cartId,
                    'product_id' => $item['item']->id,
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }
            return true;
        }
        return false;
    }

    /**
     * Get Order from table Order_product_cart
     * @return array|null
     */
    public function getOrderProductCarts()
    {
        $orderProduct = Order_cart_product::select($this->fillable)->get();

        if ($orderProduct != null) {
            return $orderProduct;
        }
        return null;
    }
}
