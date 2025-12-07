<?php

namespace Facade\Ignition\QueryRecorder;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Events\QueryExecuted;

class QueryRecorder
{
    /** @var \Facade\Ignition\QueryRecorder\Query|[] */
    protected $queries = [];

    /** @var \Illuminate\Contracts\Foundation\Application */
    protected $app;

<<<<<<< HEAD
    public function __construct(Application $app)
    {
        $this->app = $app;
=======
    /** @var bool */
    private $reportBindings;

    /** @var int|null */
    private $maxQueries;

    public function __construct(
        Application $app,
        bool $reportBindings = true,
        ?int $maxQueries = null
    ) {
        $this->app = $app;
        $this->reportBindings = $reportBindings;
        $this->maxQueries = $maxQueries;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    public function register()
    {
        $this->app['events']->listen(QueryExecuted::class, [$this, 'record']);

        return $this;
    }

    public function record(QueryExecuted $queryExecuted)
    {
<<<<<<< HEAD
        $maximumQueries = $this->app['config']->get('flare.reporting.maximum_number_of_collected_queries', 200);

        $reportBindings = $this->app['config']->get('flare.reporting.report_query_bindings', true);

        $this->queries[] = Query::fromQueryExecutedEvent($queryExecuted, $reportBindings);

        $this->queries = array_slice($this->queries, $maximumQueries * -1, $maximumQueries);
=======
        $this->queries[] = Query::fromQueryExecutedEvent($queryExecuted, $this->reportBindings);

        if (is_int($this->maxQueries)) {
            $this->queries = array_slice($this->queries, -$this->maxQueries);
        }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    public function getQueries(): array
    {
        $queries = [];

        foreach ($this->queries as $query) {
            $queries[] = $query->toArray();
        }

        return $queries;
    }

    public function reset()
    {
        $this->queries = [];
    }
<<<<<<< HEAD
=======

    public function getReportBindings(): bool
    {
        return $this->reportBindings;
    }

    public function setReportBindings(bool $reportBindings): self
    {
        $this->reportBindings = $reportBindings;

        return $this;
    }

    public function getMaxQueries(): ?int
    {
        return $this->maxQueries;
    }

    public function setMaxQueries(?int $maxQueries): self
    {
        $this->maxQueries = $maxQueries;

        return $this;
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
