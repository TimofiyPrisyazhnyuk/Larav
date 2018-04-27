<?php

namespace App\Http\Controllers\Shop;

use App\Category;
use App\CheckIfPhoto;
use App\Comment;
use App\Http\Controllers\Controller;
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
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     * @internal param null $search
     */
    public function index(Request $request, $id = null)
    {
        if (view()->exists('shop.index')) {
            $products = new Product();
            if ($search = $request->search) {
                $getProducts = $products->searchProduct($search);
            } else {
                $getProducts = (isset($id)) ? $products->getFullProducts($id) : $products->getFullProducts();
            }

            return view('shop.index', [
                'category' => $this->getCategory(),
                'products' => $getProducts,
                'recommendProducts' => $products->getRecommendProducts(),
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
        $this->validate($request, $this->rules);
        $save = Comment::create([
            'name' => $request->name,
            'comment' => $request->comment,
            'finally' => $request->finally,
            'product_id' => $id,
            'assessment' => ' ',
        ]);
        if ($save) {

            return redirect()->back()
                ->with('messageSuccess', 'Comment soon show to this page.')
                ->withInput();
        }
        return abort(404);
    }

}

