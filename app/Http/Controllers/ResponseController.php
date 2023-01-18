<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function responseView(Request $request): Response
    {
        return \response()->view('user.hello', ['name' => 'Marleess']);
    }

    public function responseJson(Request $request): JsonResponse
    {
        $body = [
            'first_name' => 'Marleess',
            'last_name' => 'Mss'
        ];
        return \response()->json($body);
    }

    public function responseFile(Request $request): BinaryFileResponse
    {
        return \response()->file(storage_path('app/public/pictures/coba.png'));
    }

    public function responseDownload(Request $request): BinaryFileResponse
    {
        return \response()->download(storage_path('app/public/pictures/laravel.png'), 'laravel.png');
    }
}
