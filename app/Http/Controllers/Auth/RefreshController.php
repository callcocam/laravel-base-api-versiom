<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Auth;

use Tymon\JWTAuth\Facades\JWTAuth;

class RefreshController extends AbstractController
{

    public function __invoke()
    {
        return $this->respondWithToken(JWTAuth::parseToken()->refresh());
    }
}
