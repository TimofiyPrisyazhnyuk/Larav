<?php

namespace App\Http\Controllers\Home;

use App\Category;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class HomeCategoryController extends Controller
{

    public $rules = [
        'name' => 'required|max:100|min:4',
    ];

    /**
     * Show
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $allCategory = Category::getCategory();
        $columnName = Category::getColumnNameCategory();

        return view('home.category.category', [
            'category' => $allCategory,
            'columnName' => $columnName,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function create(Request $request)
    {
        $data = $request->all();
        $this->validate($request, $this->rules);

        $create = Category::create([
            'name' => $data['name'],
        ]);
        if ($create) {

            return redirect()->back()
                ->with('messageSuccess', 'Created New Category');
        }
        return abort(404);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public
    function update(Request $request, $id)
    {
        $data = $request->all();
        $this->validate($request, $this->rules);
        $update = Category::find($id)->update(['name' => $data['name']]);
        if ($update) {

            return redirect()->back()
                ->with('messageSuccess', 'Category is Update!');
        }
        return abort(404);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|void
     * @internal param Request $request
     */
    public
    function delete( $id)
    {
        if (Auth::user()) {
            $deleted = Category::find($id)->delete();
            if ($deleted) {

                return redirect()->back()
                    ->with('messageSuccess', 'Category is Deleted!');
            }
        }
        return abort(404);
    }


}
