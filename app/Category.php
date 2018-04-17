<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [ 'id', 'name' ];

    /**
     * @return string
     * Bind this model from table Category
     */
    public function getTable()
    {
        return 'category';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function products()
    {
        return $this->belongsTo('App\Product');
    }

    /**
     * Get all categories from table Category
     * @return array
     */
    public static function getCategory()
    {
        $categoryArray = [];
        $allCategory   = Category::select([ 'id', 'name' ])->orderBy('id', 'desc')->get();

        foreach ($allCategory as $v) {
            $categoryArray[] = $v->attributes;
        }

        return $categoryArray;
    }

    /**
     *  Get name column from table Category
     * @return array
     */
    public static function getColumnNameCategory()
    {
        $columnName = [];
        $column     = Category::first();
        if ($column != null) {
            foreach ($column->fillable as $key => $val) {
                $columnName[] = $val;
            }

            return $columnName;
        }

        return null;
    }


}
