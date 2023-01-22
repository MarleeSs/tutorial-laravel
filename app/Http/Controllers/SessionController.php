<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request): string
    {
        $request->session()->put('UserId', 'coba');
        return 'Session Created';
    }

    public function getSession(Request $request): string
    {
        $userId = $request->session()->get('userId', 'guest');

        return "User ID : $userId";
    }
}
