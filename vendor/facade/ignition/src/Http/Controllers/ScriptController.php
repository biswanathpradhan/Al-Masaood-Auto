<?php

namespace Facade\Ignition\Http\Controllers;

use Facade\Ignition\Ignition;
use Illuminate\Http\Request;

class ScriptController
{
    public function __invoke(Request $request)
    {
<<<<<<< HEAD
=======
        if (! isset(Ignition::scripts()[$request->script])) {
            abort(404, 'Script not found');
        }

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return response(
            file_get_contents(
                Ignition::scripts()[$request->script]
            ),
            200,
            ['Content-Type' => 'application/javascript']
        );
    }
}
