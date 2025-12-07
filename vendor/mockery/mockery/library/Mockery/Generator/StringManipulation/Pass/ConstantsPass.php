<?php

<<<<<<< HEAD
namespace Mockery\Generator\StringManipulation\Pass;

use Mockery\Generator\MockConfiguration;

class ConstantsPass implements Pass
{
    public function apply($code, MockConfiguration $config)
    {
        $cm = $config->getConstantsMap();
        if (empty($cm)) {
            return $code;
        }

        if (!isset($cm[$config->getName()])) {
            return $code;
        }

        $cm = $cm[$config->getName()];

        $constantsCode = '';
        foreach ($cm as $constant => $value) {
            $constantsCode .= sprintf("\n    const %s = %s;\n", $constant, var_export($value, true));
        }

        $i = strrpos($code, '}');
        $code = substr_replace($code, $constantsCode, $i);
        $code .= "}\n";

        return $code;
=======
/**
 * Mockery (https://docs.mockery.io/)
 *
 * @copyright https://github.com/mockery/mockery/blob/HEAD/COPYRIGHT.md
 * @license https://github.com/mockery/mockery/blob/HEAD/LICENSE BSD 3-Clause License
 * @link https://github.com/mockery/mockery for the canonical source repository
 */

namespace Mockery\Generator\StringManipulation\Pass;

use Mockery\Generator\MockConfiguration;
use function array_key_exists;
use function sprintf;
use function strrpos;
use function substr_replace;
use function var_export;
use const PHP_EOL;

class ConstantsPass implements Pass
{
    /**
     * @param  string $code
     * @return string
     */
    public function apply($code, MockConfiguration $config)
    {
        $cm = $config->getConstantsMap();
        if ($cm === []) {
            return $code;
        }

        $name = $config->getName();
        if (! array_key_exists($name, $cm)) {
            return $code;
        }

        $constantsCode = '';
        foreach ($cm[$name] as $constant => $value) {
            $constantsCode .= sprintf("\n    const %s = %s;\n", $constant, var_export($value, true));
        }

        $offset = strrpos($code, '}');
        if ($offset === false) {
            return $code;
        }

        return substr_replace($code, $constantsCode, $offset) . '}' . PHP_EOL;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
