<?php

namespace Facade\Ignition\Logger;

use Facade\FlareClient\Flare;
<<<<<<< HEAD
use Facade\Ignition\Ignition;
=======
use Facade\FlareClient\Report;
use Facade\Ignition\Ignition;
use Facade\Ignition\Support\SentReports;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use Facade\Ignition\Tabs\Tab;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Throwable;

class FlareHandler extends AbstractProcessingHandler
{
    /** @var \Facade\FlareClient\Flare */
    protected $flare;

<<<<<<< HEAD
    protected $minimumReportLogLevel = Logger::ERROR;

    public function __construct(Flare $flare, $level = Logger::DEBUG, $bubble = true)
    {
        $this->flare = $flare;

=======
    /** @var \Facade\Ignition\Support\SentReports */
    protected $sentReports;

    protected $minimumReportLogLevel = Logger::ERROR;

    public function __construct(Flare $flare, SentReports $sentReports, $level = Logger::DEBUG, $bubble = true)
    {
        $this->flare = $flare;

        $this->sentReports = $sentReports;

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        parent::__construct($level, $bubble);
    }

    public function setMinimumReportLogLevel(int $level)
    {
        if (! in_array($level, Logger::getLevels())) {
            throw new \InvalidArgumentException('The given minimum log level is not supported.');
        }

        $this->minimumReportLogLevel = $level;
    }

<<<<<<< HEAD
    protected function write(array $report): void
    {
        if (! $this->shouldReport($report)) {
            return;
        }

        if ($this->hasException($report)) {
            /** @var Throwable $throwable */
            $throwable = $report['context']['exception'];
=======
    protected function write(array $record): void
    {
        if (! $this->shouldReport($record)) {
            return;
        }

        if ($this->hasException($record)) {
            /** @var Throwable $throwable */
            $throwable = $record['context']['exception'];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

            collect(Ignition::$tabs)
                ->each(function (Tab $tab) use ($throwable) {
                    $tab->beforeRenderingErrorPage($this->flare, $throwable);
                });

<<<<<<< HEAD
            $this->flare->report($report['context']['exception']);
=======
            $report = $this->flare->report($record['context']['exception']);

            if ($report) {
                $this->sentReports->add($report);
            }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

            return;
        }

        if (config('flare.send_logs_as_events')) {
<<<<<<< HEAD
            if ($this->hasValidLogLevel($report)) {
                $this->flare->reportMessage($report['message'], 'Log '.Logger::getLevelName($report['level']));
=======
            if ($this->hasValidLogLevel($record)) {
                $this->flare->reportMessage(
                    $record['message'],
                    'Log ' . Logger::getLevelName($record['level']),
                    function (Report $flareReport) use ($record) {
                        foreach ($record['context'] as $key => $value) {
                            $flareReport->context($key, $value);
                        }
                    }
                );
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            }
        }
    }

    protected function shouldReport(array $report): bool
    {
<<<<<<< HEAD
=======
        if (! config('flare.key')) {
            return false;
        }

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this->hasException($report) || $this->hasValidLogLevel($report);
    }

    protected function hasException(array $report): bool
    {
        $context = $report['context'];

        return isset($context['exception']) && $context['exception'] instanceof Throwable;
    }

    protected function hasValidLogLevel(array $report): bool
    {
        return $report['level'] >= $this->minimumReportLogLevel;
    }
}
