<?php

namespace App\Http\Controllers;

use App\Events\ActiveEvent;
use App\Models\Active;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (!Active::where('user', Auth::user()->name)->first()) {
            Active::forceCreate([
                'user' => Auth::user()->name
            ]);

            event(
                new ActiveEvent(Auth::user()->name)
            );
        }

        if (!empty($request->theme)) {
            $theme = $request->theme;

            foreach (scandir('css/theme') as $value)
                if ($value != '.' and $value != '..')
                    if ($theme === $value)
                        session(['theme' => $theme]);
        }

        return view('home');
    }
}
