<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartOrder extends Model
{

    /**
     * @var string
     */
    protected $table = 'cart';
    /**
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'phoneNumber', 'deliveryMethod', 'city',
        'totalQty', 'totalPrice',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderCartProduct()
    {
        return $this->belongsTo('App\OrderCartProduct:class');
    }

    /**
     * @return array
     * Get All CartOrders from table cart
     */
    public function getCartOrders()
    {
        $cart = [];
        $cartOrders = CartOrder::select($this->fillable)->get();

        if ($cartOrders != null) {
            foreach ($cartOrders as $key => $val) {
                $cart[] = $val->attributes;
            }
            return $cart;
        }
        return null;
    }

    /**
     * @return array
     */
    public function getCartColumnName()
    {
        $columnName = [];
        $column = CartOrder::first();
        if (isset($column)) {
            foreach ($column->fillable as $key => $val) {
                $columnName[] = $val;
            }
            return $columnName;
        }
    }


}
