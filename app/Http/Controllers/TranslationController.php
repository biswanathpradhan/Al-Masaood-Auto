<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TranslationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    public function getTranslations(Request $request)
    {

        $getTranslations = getTranslations($request);
        return $getTranslations ;
        //$language_id = isset($request->language_id): $request->language_id ? "1";

    }

    public function getTranslationsbackend(Request $request)
    {

        $getTranslations = getTranslations($request);
        return $getTranslations ;
        //$language_id = isset($request->language_id): $request->language_id ? "1";

    }
}
