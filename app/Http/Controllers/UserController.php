<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use View;
use Illuminate\Http\Request;

use \App\User;

class UserController extends Controller
{

    public function show($id, $page = null)
    {
        $user = User::findorFail($id);
     
        return View::make('pages.user.show')
            ->with('user', $user)
            ->render();
    }

    public function edit($id)
    {

        $user = User::findorFail($id);

        return View::make("pages.user.edit")
            ->with('user', $user)
            ->with('title', trans('user.edit.title'))
            ->with('url', route('user.update', [$user]))
            ->with('method', 'put')
            ->with('submit', trans('user.edit.submit'))
            ->render();

    }

    public function update(Request $request, $id)
    {

        $user = User::findorFail($id);

        $this->validate($request, [
            'name' => 'required|unique:users,name,' . $user->id,
            'email' => 'required|unique:users,email,' . $user->id,
        ]); 

        $user->update($request->all());

        return redirect()
            ->route('user.show', [$user])
            ->with('status', trans('user.update.status'));
    }

    public function showMessages($id)
    {
        $user = User::findorFail($id);
     
        return View::make('pages.user.message.index')
            ->with('user', $user)
            ->render();
    }

    public function showMessagesWith($id, $user_id_with)
    {
        $user = User::findorFail($id);
        $user_with = User::findorFail($user_id_with);
     
        return View::make('pages.user.message.with')
            ->with('user', $user)
            ->with('user_with', $user_with)
            ->with('messages', $user->messagesWith($user_id_with))
            ->render();
    }

    public function showFollows($id)
    {
        $user = User::with('follows')
            ->findorFail($id);
     
        return View::make('pages.user.follow.index')
            ->with('user', $user)
            ->render();
    }

}
