<?php

namespace App;

use Auth;
use File;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';

    protected $fillable = ['id', 'name', 'text', 'price', 'currency', 'image', 'category_id', 'user_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category()
    {
        return $this->hasMany('App\Category', 'category_id', 'id');
    }


    /**
     * Get array NameColumn from table products
     * @return array
     */
    public static function getColumnNameProducts()
    {
        $columnName = [];
        $column = Product::first();
        if ($column != null) {
            foreach ($column->fillable as $key => $val) {
                $columnName[] = $val;
            }
            return $columnName;
        }
        return null;
    }

    /**
     * Get array Products from table products
     * @param null $id
     * @return array
     */
    public static function getFullProducts($id = null)
    {
        if (!is_null($id)) {
            $getProducts = Product::orderBy('id', 'desc')
                ->where('category_id', '=', $id)
                ->get();
        } else {
            $getProducts = Product::orderBy('id', 'desc')
                ->get();
        }
        return $getProducts;
    }

    /**
     * Get products from table Recommend
     * @return array
     */
    public static function getRecommendProducts()
    {
        $products = [];
        $getProducts = Product::orderBy('price', 'asc')
            ->limit(3)
            ->get();
        foreach ($getProducts as $key => $product) {
            $products[] = $product->attributes;
        }
        return $products;
    }

    /**
     * Get Category_id from table category
     * @return array
     */
    public static function getIdAllCategories()
    {
        $category_id = [];
        $category = Category::select('id')
            ->orderBy('id', 'desc')
            ->get();

        foreach ($category as $k => $v) {
            foreach ($v->attributes as $item => $it) {
                $category_id[] = $it;
            }
        }
        return $category_id;
    }

    /**
     * Get user_id from table Users
     * @return array
     */
    public static function getIdAllUsers()
    {
        $user_id = [];
        $users = Auth::user()->getArrayableAttributes();
        foreach ($users as $user => $item) {
            if ($user == "id") {
                $user_id['id'] = $item;
            }
        }
        return $user_id;
    }

    /**
     * Get Product to Id From table Products
     * @param $id
     * @return array|mixed
     */
    public static function getProductToId($id)
    {
        $idProduct = Product::find($id);
        if ($idProduct != null) {
            return $idProduct;
        }
        return false;
    }

    /**
     * Deleting Old Photo
     * @param $id
     */
    public static function deleteOldFile($id)
    {
        $oldNameFile = Product::find($id);

        if ($deleted = $oldNameFile->getAttribute('image')) {
            File::delete('uploads/images/' . $deleted);
        }
    }


}
