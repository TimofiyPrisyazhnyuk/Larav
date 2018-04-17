<?php

namespace App\Http\Controllers\Shop;

use App\Category;
use App\CheckIfPhoto;
use App\Comment;
use App\Http\Controllers\Controller;
use App\OrderCartProduct;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    /**
     * @var array
     */
    public $rules = [
        'name' => 'required|max:50|string',
        'comment' => 'required|string|max:255|min:7',
        'finally' => 'required',
    ];

    /**
     * show Most Page Shop
     * get Category from table Category
     * get Products from table Category
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function index($id = null)
    {
        if (view()->exists('shop.index')) {
            $category = $this->getCategory();
            $recommendProducts = Product::getRecommendProducts();

            $products = (isset($id)) ? Product::getFullProducts($id) : Product::getFullProducts();

            return view('shop.index', [
                'category' => $category,
                'products' => $products,
                'recommendProducts' => $recommendProducts,
            ]);
        }
        return abort(404);
    }

    /**
     * @return array|bool
     * Get Category from table Category
     */
    public function getCategory()
    {
        $category = Category::getCategory();

        return (isset($category)) ? $category : false;

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function product($id)
    {
        $productToId = Product::getProductToId($id);
        if (isset($productToId)) {
            $photoPatch = CheckIfPhoto::CheckIfPhoto($productToId);
            $commentsToId = Comment::getCommentsToId($id);

            return view('shop.productShop', [
                'productToId' => $productToId,
                'commentsToId' => $commentsToId,
                'photoPatch' => $photoPatch,
                'id' => $id,
            ]);
        }

        return abort(404);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comments(Request $request, $id)
    {
        $data = $request->all();
        $validComment = $this->validate($request, $this->rules);
        if ($validComment) {
            Comment::create([
                'name' => $data['name'],
                'comment' => $data['comment'],
                'finally' => $data['finally'],
                'product_id' => $id,
                'assessment' => ' ',
            ]);
            return redirect()->back()
                ->with('messageSuccess', 'Comment is Add!')
                ->withInput();
        }
        return abort(404);
    }


}

