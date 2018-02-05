<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserLoginRequest;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Log a user in.
     *
     * @param UserLoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        $token = JWTAuth::attempt($request->only('email', 'password'));
        abort_unless($token, 401, 'Invalid credentials');
        return response()->json(compact('token'));
    }

    /**
     * Log the current user out.
     *
     * @return JsonResponse
     */
    public function logout()
    {
        if ($token = JWTAuth::getToken()) {
            try {
                JWTAuth::invalidate($token);
            } catch (Exception $e) {
                Log::error($e);
            }
        }

        return response()->json();
    }

    /**
     *
     */
    public function update() {
        $token = JWTAuth::getToken();
        if ($token) {
            try {
                $token = JWTAuth::refresh($token);
            } catch (Exception $e) {
                Log::error($e);
            }
        }

        return response()->json(compact('token'));
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->stateless()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     * @throws Exception
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->stateless()->user();

        if (!$user) {
            throw new Exception();
        }

        if (User::where('email', $user->email)
            ->whereNull('github_id')
            ->first()) {
            throw new Exception();
        }

        $systemUser = User::where('github_id', $user->id)->first();
        if (!$systemUser) {
            $systemUser = User::create([
                'name' => $user->nickname,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'github_id' => $user->id
            ]);
        }

        $token = JWTAuth::fromUser($systemUser);
        abort_unless($token, 401, 'Invalid credentials');
        return Redirect::route('index', compact('token'));
    }
}
