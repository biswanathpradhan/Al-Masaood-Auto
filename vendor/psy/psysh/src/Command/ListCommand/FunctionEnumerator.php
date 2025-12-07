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

namespace Psy\Command\ListCommand;

use Psy\Reflection\ReflectionNamespace;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Function Enumerator class.
 */
class FunctionEnumerator extends Enumerator
{
    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    protected function listItems(InputInterface $input, \Reflector $reflector = null, $target = null): array
=======
    protected function listItems(InputInterface $input, ?\Reflector $reflector = null, $target = null): array
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        // if we have a reflector, ensure that it's a namespace reflector
        if (($target !== null || $reflector !== null) && !$reflector instanceof ReflectionNamespace) {
            return [];
        }

        // only list functions if we are specifically asked
        if (!$input->getOption('functions')) {
            return [];
        }

        if ($input->getOption('user')) {
            $label = 'User Functions';
            $functions = $this->getFunctions('user');
        } elseif ($input->getOption('internal')) {
            $label = 'Internal Functions';
            $functions = $this->getFunctions('internal');
        } else {
            $label = 'Functions';
            $functions = $this->getFunctions();
        }

        $prefix = $reflector === null ? null : \strtolower($reflector->getName()).'\\';
        $functions = $this->prepareFunctions($functions, $prefix);

        if (empty($functions)) {
            return [];
        }

        $ret = [];
        $ret[$label] = $functions;

        return $ret;
    }

    /**
     * Get defined functions.
     *
     * Optionally limit functions to "user" or "internal" functions.
     *
     * @param string|null $type "user" or "internal" (default: both)
     *
     * @return array
     */
<<<<<<< HEAD
    protected function getFunctions(string $type = null): array
=======
    protected function getFunctions(?string $type = null): array
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        $funcs = \get_defined_functions();

        if ($type) {
            return $funcs[$type];
        } else {
            return \array_merge($funcs['internal'], $funcs['user']);
        }
    }

    /**
     * Prepare formatted function array.
     *
<<<<<<< HEAD
     * @param array  $functions
     * @param string $prefix
     *
     * @return array
     */
    protected function prepareFunctions(array $functions, string $prefix = null): array
=======
     * @param array       $functions
     * @param string|null $prefix
     *
     * @return array
     */
    protected function prepareFunctions(array $functions, ?string $prefix = null): array
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        \natcasesort($functions);

        // My kingdom for a generator.
        $ret = [];

        foreach ($functions as $name) {
            if ($prefix !== null && \strpos(\strtolower($name), $prefix) !== 0) {
                continue;
            }

            if ($this->showItem($name)) {
                try {
                    $ret[$name] = [
                        'name'  => $name,
                        'style' => self::IS_FUNCTION,
                        'value' => $this->presentSignature($name),
                    ];
                } catch (\Throwable $e) {
                    // Ignore failures.
                }
            }
        }

        return $ret;
    }
}
