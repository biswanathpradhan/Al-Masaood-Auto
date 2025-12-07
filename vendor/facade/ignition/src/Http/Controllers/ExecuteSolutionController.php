<?php

namespace Facade\Ignition\Http\Controllers;

use Facade\Ignition\Http\Requests\ExecuteSolutionRequest;
use Facade\IgnitionContracts\SolutionProviderRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ExecuteSolutionController
{
    use ValidatesRequests;

    public function __invoke(
        ExecuteSolutionRequest $request,
        SolutionProviderRepository $solutionProviderRepository
    ) {
<<<<<<< HEAD
=======
        $this->ensureLocalEnvironment();
        $this->ensureLocalRequest();

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $solution = $request->getRunnableSolution();

        $solution->run($request->get('parameters', []));

        return response('');
    }
<<<<<<< HEAD
=======

    public function ensureLocalEnvironment()
    {
        if (! app()->environment('local')) {
            abort(403, "Runnable solutions are disabled in non-local environments. Please make sure `APP_ENV` is set correctly. Additionally please make sure `APP_DEBUG` is set to false on ANY production environment!");
        }
    }

    public function ensureLocalRequest()
    {
        $ipIsPublic = filter_var(
            request()->ip(),
            FILTER_VALIDATE_IP,
            FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        );

        if ($ipIsPublic) {
            abort(403, "Solutions can only be executed by requests from a local IP address. Please also make sure `APP_DEBUG` is set to false on ANY production environment.");
        }
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
