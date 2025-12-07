<?php

namespace Facade\Ignition\Middleware;

use Facade\FlareClient\Report;

class SetNotifierName
{
<<<<<<< HEAD
    const NOTIFIER_NAME = 'Laravel Client';
=======
    public const NOTIFIER_NAME = 'Laravel Client';
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    public function handle(Report $report, $next)
    {
        $report->notifierName(static::NOTIFIER_NAME);

        return $next($report);
    }
}
