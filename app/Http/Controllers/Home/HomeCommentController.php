<?php

namespace App\Http\Controllers\Home;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeCommentController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function comment()
    {
        $comments = Comment::getCommentsToId();

        return view('home.comments.comments', ['commentsToId' => $comments]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeComment(Request $request, $id)
    {
        if (isset($id)) {
            $changeComment = Comment::where('id', $id)->update([
                'checkAdmin' => 1,
            ]);
            if ($changeComment) {
                return redirect()->back()
                    ->with('messageSuccess', 'Comments is Add')->withInput();
            }
            return redirect()->back()
                ->with('messageWarning', 'Comments not Add')->withInput();
        }
        return abort(404);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteComment(Request $request, $id)
    {
        if (isset($id)) {
            Comment::where('id', $id)->delete();
            return redirect()->back()
                ->with('messageSuccess', 'Comments is Deleted')->withInput();
        }
        return redirect()->back()
            ->with('messageWarning', 'Comments not Deleted')->withInput();
    }

}
