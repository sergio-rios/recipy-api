<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $this->showAll($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'nick' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255|regex:#^[A-Za-zÁÉÍÓÚñáéíóúÑ\s]+$#',           
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'description' => 'string',
            'photo' => 'image|mimes:jpeg,jpg,png|max:10000',
            'enabled' => 'required|boolean'
        ]);

        $defaultProfile = Profile::where('profile', 'user')->first();

        $userData = $request->all();
        $userData['password'] = bcrypt($request->password);
        $userData['profile_id'] = $defaultProfile->id;

        $user = User::create($userData);

        return $this->showOne($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validate = $this->validate($request, [
            'nick' => 'string|max:255|unique:users,nick,'.$user->id,
            'profile' => 'integer',
            'name' => 'string|max:255|regex:#^[A-Za-zÁÉÍÓÚñáéíóúÑ\s]+$#',           
            'email' => 'string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'string|min:4|confirmed',
            'description' => 'string',
            'photo' => 'image|mimes:jpeg,jpg,png|max:10000',
            'enabled' => 'boolean'
        ]);
        
        $user->fill(Input::all());
        
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if (!$user->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actulizar', 422);
        }

        $user->save();

        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return $this->showOne($user);
    }
}
