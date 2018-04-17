<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table    = 'comments';
    protected $fillable = [ 'id', 'name', 'comment', 'assessment', 'finally', 'product_id' ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function products()
    {
        return $this->belongsTo('App\Product', 'id');
    }

    /**
     * @param $id
     * @return array|bool
     */
    public static function getCommentsToId($id)
    {
        $getCommentsToId = [];
        $product         = Product::with('comments')->where('id', $id)->get();

        if ($product != null) {
            foreach ($product as $comment) {
                if (!empty($comment->comments[ 0 ])) {
                    $getCommentsToId[] = $comment->comments;
                }
            }

            return $getCommentsToId;
        }

        return false;
    }

}
