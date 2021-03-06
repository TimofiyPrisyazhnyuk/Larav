<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
     * @var string
     */
    protected $table = 'comments';
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'comment',
        'assessment',
        'finally',
        'product_id',
        'checkAdmin',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function products()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    /**
     * @param $id
     * @return array|bool
     */
    public static function getCommentsToId(int $id = null)
    {
        $getCommentsToId = [];
        if (isset($id)) {
            $product = Product::with('comments')
                ->where('id', $id)->get();
            if ($product != null) {
                foreach ($product as $comment) {
                    if (!empty($comment->comments[0])) {
                        $getCommentsToId[] = $comment->comments;
                    }
                }
                return $getCommentsToId;
            }
        } else if (!isset($id)) {
            return $product = Comment::with('products')
                ->where('checkAdmin', 0)->get();
        }
        return false;
    }

}
