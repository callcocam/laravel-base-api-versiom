<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;

class LoginController extends AbstractController
{

    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $authenticate = $this->guard()->attempt($credentials);
        if ($authenticate) {
            // Generate Token
            $token = \JWTAuth::fromUser($this->guard()->user());

            return $this->respondWithToken($token);
        }

        return response()->json([
            'error' => 'Unauthorized',
            'errors'=>[
                'email'=>[trans('auth.failed')]
            ]], 422);
    }
}
