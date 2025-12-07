<?php

namespace Facade\Ignition\SolutionProviders;

use Facade\IgnitionContracts\BaseSolution;
use Facade\IgnitionContracts\HasSolutionsForThrowable;
use Illuminate\Support\Str;
use ParseError;
use Throwable;

class MergeConflictSolutionProvider implements HasSolutionsForThrowable
{
    public function canSolve(Throwable $throwable): bool
    {
        if (! ($throwable instanceof ParseError)) {
            return false;
        }

<<<<<<< HEAD
        if (! Str::startsWith($throwable->getMessage(), 'syntax error, unexpected \'<<\'')) {
=======
        if (! $this->hasMergeConflictExceptionMessage($throwable)) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            return false;
        }

        $file = file_get_contents($throwable->getFile());

        if (strpos($file, '=======') === false) {
            return false;
        }

        if (strpos($file, '>>>>>>>') === false) {
            return false;
        }

        return true;
    }

    public function getSolutions(Throwable $throwable): array
    {
        $file = file_get_contents($throwable->getFile());
        preg_match('/\>\>\>\>\>\>\> (.*?)\n/', $file, $matches);
        $source = $matches[1];

        $target = $this->getCurrentBranch(basename($throwable->getFile()));

        return [
            BaseSolution::create("Merge conflict from branch '$source' into $target")
                ->setSolutionDescription('You have a Git merge conflict. To undo your merge do `git reset --hard HEAD`'),
        ];
    }

<<<<<<< HEAD
    private function getCurrentBranch(string $directory): string
    {
        $branch = "'".trim(shell_exec("cd ${directory}; git branch | grep \\* | cut -d ' ' -f2"))."'";

        if (! isset($branch) || $branch === "''") {
=======
    protected function getCurrentBranch(string $directory): string
    {
        $branch = "'".trim(shell_exec("cd {$directory}; git branch | grep \\* | cut -d ' ' -f2"))."'";

        if ($branch === "''") {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            $branch = 'current branch';
        }

        return $branch;
    }
<<<<<<< HEAD
=======

    protected function hasMergeConflictExceptionMessage(Throwable $throwable): bool
    {
        // For PHP 7.x and below
        if (Str::startsWith($throwable->getMessage(), 'syntax error, unexpected \'<<\'')) {
            return true;
        }

        // For PHP 8+
        if (Str::startsWith($throwable->getMessage(), 'syntax error, unexpected token "<<"')) {
            return true;
        }

        return false;
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
