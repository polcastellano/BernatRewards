<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    public function user(Request $request)
    {
        $user = $request->user();

        $user = User::with('niveles')->with('roles')->with('media')->find($user->id);

        return $this->successResponse($user, 'User found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @throws ValidationException
     * @return UserResource
     */
    public function update(UpdateUserRequest $request)
    {
        $usuario = User::with('media')->with('niveles')->find($request->id);
        
        $roles = Role::find($request->roles);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->puntos = $request->puntos;
        $usuario->experience = $request->experience;

        if (!empty($request->password)) {
            $usuario->password = Hash::make($request->password) ?? $usuario->password;
        }


        if ($request->hasFile('imagen')) {
            $usuario->media()->delete();
            $usuario->addMediaFromRequest('imagen')->preservingOriginal()->toMediaCollection('images-usuarios');

        }
        


        if ($usuario->save()) {
            if ($roles) {
                $usuario->syncRoles($roles);
            }
   
            $usuario = User::with('media')->with('niveles')->with('roles')->find($request->id);

            return $usuario;
            // return UserResource::collection($usuario);
        }
    }

    /**
     * Display the specified User.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function show(User $user)
    {   

        $user = User::with('niveles')->with('roles')->with('media')->find($user->id);

        $user->load('roles');

        return new UserResource($user);
    }

}
