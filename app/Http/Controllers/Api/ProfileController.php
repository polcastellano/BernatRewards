<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Http\Resources\UserResource;


class ProfileController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function update(UpdateProfileRequest $request)
    {
        $profile = Auth::user();
        $profile->name = $request->name;
        $profile->email = $request->email;

        if ($profile->save()) {
            return $this->successResponse($profile, 'User updated');;
        }
        return response()->json(['status' => 403, 'success' => false]);
    }

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
     * @return UserResource
     */
    // public function update(UpdateUserRequest $request)
    // {
    //     $usuario = User::find($request->id);

    //     $roles = Role::find($request->roles);

    //     $usuario->name = $request->name;
    //     $usuario->email = $request->email;

    //     if (!empty($request->password)) {
    //         $usuario->password = Hash::make($request->password) ?? $usuario->password;
    //     }


    //     if ($request->hasFile('imagen')) {
    //         $usuario->media()->delete();
    //         $usuario->addMediaFromRequest('imagen')->preservingOriginal()->toMediaCollection('images-usuarios');
    //     }



    //     if ($usuario->save()) {
    //         if ($roles) {
    //             $usuario->syncRoles($roles);
    //         }
    //         return $usuario;
    //         // return UserResource::collection($usuario);
    //     }
    // }

    /**
     * Display the specified User.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function show(User $user)
    {   

        $user->load('roles');

        return new UserResource($user);
    }

}
