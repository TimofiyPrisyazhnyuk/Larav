<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{

    /**
     * @var array
     */

    public $rules = [
        'file' => 'image:jpg,png|max:5000|dimensions:min_width=350,min_height=350',
    ];

    /**
     * @var string
     */

    public $uploadPath = 'uploads/images';


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function upload(Request $request, $id)
    {
        $validate = $this->validate($request, $this->rules);
        if ($validate) {
            $save = $this->savePhoto($request, $id);
            if ($save != false) {
                return redirect()->back()
                    ->with('messageSuccess', 'Photo add to this products');
            }
        }

        return redirect()->back()
            ->with('messageWarning', 'Your file exist ');
    }

    /**
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function savePhoto(Request $request, $id)
    {
        $file      = $request->file('file');
        $PhotoName = time() . $file->getClientOriginalName();

        if ($file->move($this->uploadPath, $PhotoName)) {
            Product::deleteOldFile($id);
            $saveToDb = new Product();
            $saveToDb->where('id', $id)->update([
                'image' => $PhotoName,
            ]);

            return true;
        }

        return false;

    }


}
