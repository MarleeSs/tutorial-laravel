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

    public function inputType(Request $request): string
    {
        $name = $request->input('name');
        $married = $request->boolean('married');
        $date = $request->date('date', 'Y-m-d');

        return json_encode([
           'name' => $name,
           'married' => $married,
           'date' => $date->format('Y-m-d')
        ]);
    }
    public function filterOnly(Request $request): string
    {
        $name = $request->only("name.first", "name.last");
        return json_encode($name);
    }

    public function filterExcept(Request $request): string
    {
        $user = $request->except("admin");
        return json_encode($user);
    }

    public function filterMerge(Request $request): string
    {
        $request->merge([
            "admin" => false
        ]);
        $user = $request->input();
        return json_encode($user);
    }
}
