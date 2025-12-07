<?php

<<<<<<< HEAD

=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
namespace Facade\Ignition\SolutionProviders;

use Facade\IgnitionContracts\BaseSolution;
use Facade\IgnitionContracts\HasSolutionsForThrowable;
use Illuminate\Support\Str;
use Throwable;

class MissingMixManifestSolutionProvider implements HasSolutionsForThrowable
{
    public function canSolve(Throwable $throwable): bool
    {
        return Str::startsWith($throwable->getMessage(), 'The Mix manifest does not exist');
    }

    public function getSolutions(Throwable $throwable): array
    {
        return [
            BaseSolution::create('Missing Mix Manifest File')
<<<<<<< HEAD
                ->setSolutionDescription('Did you forget to run `npm install && npm run dev`?'),
=======
                ->setSolutionDescription('Did you forget to run `npm ci && npm run dev`?'),
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        ];
    }
}
