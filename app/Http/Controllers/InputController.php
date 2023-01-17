<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request): string
    {
        $name = $request->input('name');
        return "Hello $name";
    }

    public function helloNested(Request $request): string
    {
        $name = $request->input('name.first');
        return "Hello " . $name;
    }

    public function inputEncode(Request $request): string
    {
        $input = $request->input();
        return json_encode($input);
    }
    // TODO input type
}
