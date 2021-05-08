<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $themes = [];
        foreach (scandir('css/theme') as $value)
            if ($value != '.' and $value != '..')
                $themes[] = $value;

        return view('setting', ['themes' => $themes]);
    }
}
