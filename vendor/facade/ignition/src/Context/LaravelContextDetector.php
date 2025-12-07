<?php

namespace Facade\Ignition\Context;

use Facade\FlareClient\Context\ContextDetectorInterface;
use Facade\FlareClient\Context\ContextInterface;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use Livewire\LivewireManager;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

class LaravelContextDetector implements ContextDetectorInterface
{
    public function detectCurrentContext(): ContextInterface
    {
        if (app()->runningInConsole()) {
            return new LaravelConsoleContext($_SERVER['argv'] ?? []);
        }

<<<<<<< HEAD
        return new LaravelRequestContext(app(Request::class));
=======
        $request = app(Request::class);

        if ($this->isRunningLiveWire($request)) {
            return new LivewireRequestContext($request, app(LivewireManager::class));
        }

        return new LaravelRequestContext($request);
    }

    protected function isRunningLiveWire(Request $request)
    {
        return $request->hasHeader('x-livewire') && $request->hasHeader('referer');
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
