<<<<<<< HEAD
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\ValidationHelper;

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
        // XSS Protection: Validate language_id parameter
        $validator = Validator::make($request->all(), [
            'language_id' => ValidationHelper::languageId(false)
        ], ValidationHelper::errorMessages());

        if ($validator->fails()) {
            return ["status" => "0", "response_message" => "error", "display_message" => "Invalid input parameters", "error_message" => $validator->errors()];
        }

        $getTranslations = getTranslations($request);
        return $getTranslations;
    }

    public function getTranslationsbackend(Request $request)
    {

        $getTranslations = getTranslations($request);
        return $getTranslations ;
        //$language_id = isset($request->language_id): $request->language_id ? "1";

    }
}
=======
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
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
