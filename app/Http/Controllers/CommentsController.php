<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'comment' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $yourModel = new Comments;

        // Set the values from the form data
        $yourModel->onPostTitle = $request->title;
        $yourModel->comment = $request->comment;
        $yourModel->Username = $request->user()->name;

        $yourModel->save();

        return redirect()->back();
    }

    public function createreply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'onPostTitle' => 'required',
            'comment' => 'required',
            'onCommentId' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $yourModel = new \App\Models\Replies;

        // Set the values from the form data
        $yourModel->onPostTitle = $request->onPostTitle;
        $yourModel->onCommentId = $request->onCommentId;
        $yourModel->comment = $request->comment;
        $yourModel->Username = $request->user()->name;

        $yourModel->save();

        return redirect()->back();
    }



}