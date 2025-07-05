<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ChatController extends Controller
{
    public function index()
    {
        $data = Chat::orderBy('id','desc')->get();

        return view('admin.chat.index', compact('data'));
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required',
            'comment' => 'required'
        ]);

        Chat::create($request->all());

        return redirect()->back()->with('success', __('messages.Chat-send-success'));
    }

    public function edit(Chat $Chat)
    {

        $data = $Chat;

        return view('admin.chat.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $Chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $Chat)
    {
        $data = $Chat;
        $data->update($request->all());

        return redirect()->route('chat.index')->with('success',$data->Chat  . ' '. Lang::get('messages.edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $Chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $Chat)
    {
        $Chat->delete();

        return redirect()->route('chat.index')->with('success', Lang::get('messages.deleted'));
    }
}
