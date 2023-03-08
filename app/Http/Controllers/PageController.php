<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $tokens = DB::table('test_tokens')->get();

        return view('dashboard')->with([
            'tokens' => $tokens,
        ]);
    }
}
