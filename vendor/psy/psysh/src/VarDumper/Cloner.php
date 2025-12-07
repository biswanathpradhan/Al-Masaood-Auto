<?php

/*
 * This file is part of Psy Shell.
 *
<<<<<<< HEAD
 * (c) 2012-2023 Justin Hileman
=======
 * (c) 2012-2025 Justin Hileman
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\VarDumper;

use Symfony\Component\VarDumper\Caster\Caster;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Cloner\Stub;
use Symfony\Component\VarDumper\Cloner\VarCloner;

/**
 * A PsySH-specialized VarCloner.
 */
class Cloner extends VarCloner
{
<<<<<<< HEAD
    private $filter = 0;
=======
    private int $filter = 0;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * {@inheritdoc}
     */
    public function cloneVar($var, $filter = 0): Data
    {
        $this->filter = $filter;

        return parent::cloneVar($var, $filter);
    }

    /**
     * {@inheritdoc}
     */
    protected function castResource(Stub $stub, $isNested): array
    {
        return Caster::EXCLUDE_VERBOSE & $this->filter ? [] : parent::castResource($stub, $isNested);
    }
}
