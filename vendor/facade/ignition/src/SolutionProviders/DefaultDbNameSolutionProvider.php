<?php

namespace Facade\Ignition\SolutionProviders;

use Facade\Ignition\Solutions\SuggestUsingCorrectDbNameSolution;
use Facade\IgnitionContracts\HasSolutionsForThrowable;
use Illuminate\Database\QueryException;
use Throwable;

class DefaultDbNameSolutionProvider implements HasSolutionsForThrowable
{
<<<<<<< HEAD
    const MYSQL_UNKNOWN_DATABASE_CODE = 1049;
=======
    public const MYSQL_UNKNOWN_DATABASE_CODE = 1049;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    public function canSolve(Throwable $throwable): bool
    {
        if (! $throwable instanceof QueryException) {
            return false;
        }

        if ($throwable->getCode() !== self::MYSQL_UNKNOWN_DATABASE_CODE) {
            return false;
        }

        if (! in_array(env('DB_DATABASE'), ['homestead', 'laravel'])) {
            return false;
        }

        return true;
    }

    public function getSolutions(Throwable $throwable): array
    {
        return [new SuggestUsingCorrectDbNameSolution()];
    }
}
