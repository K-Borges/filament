<?php

  namespace App\Http\Controllers\Api;

  use App\Http\Controllers\Controller;
  use App\Models\User;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Validation\ValidationException;

  class AuthController extends Controller
  {
      public function register(Request $request)
      {
          $data = $request->validate([
              'name'     => ['required', 'string', 'max:255'],
              'email'    => ['required', 'email', 'unique:users'],
              'password' => ['required', 'string', 'min:3'],
          ]);

          $user  = User::create($data);
          $token = $user->createToken('api')->plainTextToken;

          return response()->json(['token' => $token], 201);
      }

      public function login(Request $request)
      {
          $request->validate([
              'email'    => ['required', 'email'],
              'password' => ['required'],
          ]);

          if (! Auth::attempt($request->only('email', 'password'))) {
              throw ValidationException::withMessages([
                  'email' => ['Credenciais inválidas.'],
              ]);
          }

          $token = Auth::user()->createToken('api')->plainTextToken;

          return response()->json(['token' => $token]);
      }

      public function logout(Request $request)
      {
          $request->user()->currentAccessToken()->delete();

          return response()->noContent();
      }
  }


