<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class CommentController extends Controller
{

    public function index()
    {
        $data = Comment::orderBy('id', 'desc')->paginate(12);

        return view('admin.comment.index', compact('data'));
    }


    public function store(Request $request)
    {

        if ($request->name != '' || $request->comment != '') {
            $request->validateWithBag('comment_error', [
                'rate' => 'required',
                'name' => 'required',
                'comment' => 'required'
            ], [
                'rate.required' => 'امتیاز را انتخاب نمایید',
                'name.required' => 'نام را وارد نمایید',
                'comment.required' => 'پیام را وارد نمایید',
            ]);

            $data = $request->all();
        } else {
            $data = $request->all();
            $data['status'] = 1;
        }


        Comment::create($data);

        return redirect()->back()->with('comment_success', __('messages.comment-send-success'));
    }


    public function edit(Comment $comment)
    {
        $data = $comment;
        return view('admin.comment.edit', compact('data'));
    }


    public function update(CommentRequest $request, Comment $comment)
    {

        $data = $comment;
        $data->update($request->all());

        return redirect()->route('comment.index')->with('success', $data->comment . ' ' . Lang::get('messages.edited'));
    }


    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comment.index')->with('success', Lang::get('messages.deleted'));
    }
}
