<?php

namespace App\Http\Controllers;

use App\Models\GardenImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function login(Request $request) {

        $validated = $request->validate([

            'email'         => 'required|email',
            'password'      => 'required'
        ]);

        if (!Auth::attempt($validated)) {

            return response()->json([

                'message' => 'Informações de login inválidas.'
            ], 401);
        }

        $user = User::where('email', $validated['email'])->first();

        return response()->json([

            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    public function register(Request $request)  {

        $validated = $request->validate([

            'name'          => 'required|max:255',
            'email'         => 'required|max:255|email|unique:users,email',
            'password'      => 'required|confirmed|min:6'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        if (isset($validated['image_base_64']) && $validated['image_base_64'] != NULL) {

            $image_64 = $validated['image_base_64'];
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
            $replace = substr($image_64, 0, strpos($image_64, ',')+1);

            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(10) . uniqid() . '.' . $extension;
            Storage::put($imageName, base64_decode($image));

            $user->image_file = $validated['image_base_64'];
            $user->save();
        }

        return response()->json([

            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer',
            'user' => $user
        ], 201);
    }
}
