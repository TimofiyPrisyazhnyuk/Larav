<?php

namespace App\Http\Controllers\Home;

use App\CheckIfPhoto;
use App\Http\Controllers\Controller;
use App\Product;
use Auth;
use Illuminate\Http\Request;

class HomeProductController extends Controller
{

    /**
     * @var array
     */
    public $rules = [
        'name' => 'required|string|max:100|min:3',
        'text' => 'required|string|min:3',
        'image' => 'string|default:null',
        'price' => 'required|numeric',
        'currency' => 'required|string|max:21',
        'category_id' => 'required|int',
        'user_id' => 'required|int',
    ];

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = new Product();

        return view('home.products.products', [
            'columnName' => $products->getColumnNameProducts(),
            'products' => $products->getFullProducts(),
        ]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createProducts()
    {
        $product = new Product();

        return view('home.products.create', [
            'category_id' => $product->getIdAllCategories(), $product->getIdAllUsers(),
            'user_id' => $product->getIdAllUsers(),
        ]);
    }

    /**
     *  Create new product
     * validate + save to db
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $validated = $this->validate($request, $this->rules);
        $user = Auth::user();

        if ($validated && $user) {
            $user->products()->create([
                'name' => $data['name'],
                'text' => $data['text'],
                'price' => $data['price'],
                'currency' => $data['currency'],
                'category_id' => $data['category_id'],
                'user_id' => $data['user_id'],
            ]);
            return redirect()->back()
                ->with('messageSuccess', 'Success Data is Add');
        }
        return abort(404);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function present($id)
    {
        $productToId = Product::getProductToId($id);
        if ($productToId != null) {
            $photoPatch = CheckIfPhoto::CheckIfPhoto($productToId);

            return view('home.products.present', [
                'id' => $id,
                'productToId' => $productToId,
                'photoPatch' => $photoPatch,
            ]);
        }
        return abort(404);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateShow($id)
    {
        $product = new Product();
        $getUpdatesData = Product::getProductToId($id);
        $photoPatch = CheckIfPhoto::CheckIfPhoto($getUpdatesData);

        return view('home.products.update', [
            'id' => $id,
            'getUpdatesData' => $getUpdatesData,
            'category_id' => $product->getIdAllCategories(),
            'user_id' => $product->getIdAllUsers(),
            'photoPatch' => $photoPatch,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveUpdate(Request $request, $id)
    {
        $data = $request->all();
        $validated = $this->validate($request, $this->rules);
        if ($validated) {
            $update = new Product();
            $update->where('id', $id)->update([
                'name' => $data['name'],
                'text' => $data['text'],
                'price' => $data['price'],
                'currency' => $data['currency'],
                'category_id' => $data['category_id'],
                'user_id' => $data['user_id'],
            ]);
        }

        return redirect()->back()
            ->with('messageSuccess', 'Success Data is Update');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $delete = new Product();
        Product::deleteOldFile($id);
        $delete->where('id', $id)->delete();

        if ($delete) {
            return redirect()
                ->route('home_products')
                ->with('messageSuccess', 'Product deleted');
        }
        return redirect()->back()
            ->with('messageWarning', 'Warning : product do not deleted');
    }

}
