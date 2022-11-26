<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    use ApiResponse;

    public function show_profile($user_id){
        $user = User::where('id', $user_id)->first();

        return $this->apiSuccess($user);
    }

    public function update_profile_image(Request $request, $id){
        // UploadProfileRequest
        $validated = $request->validated();
        $user = User::where('id', $id)->first();
        if($user->image != null && file_exists(storage_path('app/public/'.$user->image))){
            Storage::delete(['public/', $user->image]);
        }

        $validated['image'] = $request->file('image')->store('profiles/'.$id, 'public');
        
        User::where('id', $id)->update([
            'image' => ($validated['image'] == null) ? '' : $validated['image'],
        ]);

        $response = User::where('id', $id)->first();

        return $this->apiSuccess($response);
    }

    public function update_profile(ProfileUpdateRequest $request, $id)
    {
        $validated = $request->validated();

        User::where('id', $id)->update([
            'name' => $validated['name'],
            'address' => $validated['address'],
        ]);

        $user = User::where('id', $id)->first();

        return $this->apiSuccess($user);
    }

    public function update_password(PasswordUpdateRequest $request, $id){
        $validated = $request->validated();
        
        $check = User::where('id', $id)->first();

        if (!(Hash::check($validated['old_password'], $check->password))) {
            return $this->apiError('Your old password doesn`t match!', 400);
        }

        User::where('id', $id)->update([
            'password' => Hash::make($validated['password']),
        ]);

        $user = User::where('id', $id)->first();

        return $this->apiSuccess($user);
    }
}
