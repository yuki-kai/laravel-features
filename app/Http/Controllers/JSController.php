<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class JSController extends Controller
{
    /**
     * FizzBuzz画面
     *
     * @return view
     */
    public function fizzbuzz()
    {
        return view('js.fizzbuzz');
    }

    /**
     * Promise画面
     *
     * @return view
     */
    public function promise()
    {
        return view('js.promise');
    }
}
