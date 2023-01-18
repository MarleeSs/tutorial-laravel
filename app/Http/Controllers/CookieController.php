<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    public function createCookie(): Response
    {
        return response('Hello cookie')
            ->cookie('User-Id', 'coba', '100', '/')
            ->cookie('Is-Member', 'true', 10, '/');
    }

    public function getCookie(Request $request): JsonResponse
    {
        return response()
            ->json([
                'userId' => $request->cookie('User-Id', 'guest'),
                'isMember' => $request->cookie('Is-Member', 'false')
            ]);
    }

    public function clearCookie(Request $request): Response
    {
        return response('Clear Cookie')
            ->withOutCookie('User-Id')
            ->withOutCookie('Is-Member');
    }
}
