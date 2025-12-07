<?php

namespace Carbon\Doctrine;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use DateTimeInterface;
use Doctrine\DBAL\Platforms\AbstractPlatform;
<<<<<<< HEAD
=======
use Doctrine\DBAL\Platforms\DB2Platform;
use Doctrine\DBAL\Platforms\OraclePlatform;
use Doctrine\DBAL\Platforms\SqlitePlatform;
use Doctrine\DBAL\Platforms\SQLServerPlatform;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use Doctrine\DBAL\Types\ConversionException;
use Exception;

/**
 * @template T of CarbonInterface
 */
trait CarbonTypeConverter
{
    /**
     * This property differentiates types installed by carbonphp/carbon-doctrine-types
     * from the ones embedded previously in nesbot/carbon source directly.
     *
     * @readonly
<<<<<<< HEAD
     *
     * @var bool
     */
    public $external = true;
=======
     */
    public bool $external = true;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * @return class-string<T>
     */
    protected function getCarbonClassName(): string
    {
        return Carbon::class;
    }

<<<<<<< HEAD
    /**
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $maximum = CarbonDoctrineType::MAXIMUM_PRECISION;
        $precision = ($fieldDeclaration['precision'] ?? null) ?: $maximum;

        if ($fieldDeclaration['secondPrecision'] ?? false) {
            $precision = 0;
        }

        if ($precision === $maximum) {
            $precision = DateTimeDefaultPrecision::get();
        }
=======
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        $precision = min(
            $fieldDeclaration['precision'] ?? DateTimeDefaultPrecision::get(),
            $this->getMaximumPrecision($platform),
        );
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

        $type = parent::getSQLDeclaration($fieldDeclaration, $platform);

        if (!$precision) {
            return $type;
        }

        if (str_contains($type, '(')) {
            return preg_replace('/\(\d+\)/', "($precision)", $type);
        }

        [$before, $after] = explode(' ', "$type ");

        return trim("$before($precision) $after");
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @return T|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $class = $this->getCarbonClassName();

        if ($value === null || is_a($value, $class)) {
            return $value;
        }

        if ($value instanceof DateTimeInterface) {
            return $class::instance($value);
        }

        $date = null;
        $error = null;

        try {
            $date = $class::parse($value);
        } catch (Exception $exception) {
            $error = $exception;
        }

        if (!$date) {
            throw ConversionException::conversionFailedFormat(
                $value,
<<<<<<< HEAD
                $this->getName(),
=======
                $this->getTypeName(),
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                'Y-m-d H:i:s.u or any format supported by '.$class.'::parse()',
                $error
            );
        }

        return $date;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
<<<<<<< HEAD
     *
     * @return string|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
=======
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        if ($value === null) {
            return $value;
        }

        if ($value instanceof DateTimeInterface) {
            return $value->format('Y-m-d H:i:s.u');
        }

<<<<<<< HEAD
        $method = method_exists(ConversionException::class, 'conversionFailedInvalidType')
            ? 'conversionFailedInvalidType'
            : 'conversionFailed'; // @codeCoverageIgnore

        throw ConversionException::$method(
            $value,
            $this->getName(),
            ['null', 'DateTime', 'Carbon']
        );
    }
=======
        throw ConversionException::conversionFailedInvalidType(
            $value,
            $this->getTypeName(),
            ['null', 'DateTime', 'Carbon']
        );
    }

    private function getTypeName(): string
    {
        $chunks = explode('\\', static::class);
        $type = preg_replace('/Type$/', '', end($chunks));

        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $type));
    }

    private function getMaximumPrecision(AbstractPlatform $platform): int
    {
        if ($platform instanceof DB2Platform) {
            return 12;
        }

        if ($platform instanceof OraclePlatform) {
            return 9;
        }

        if ($platform instanceof SQLServerPlatform || $platform instanceof SqlitePlatform) {
            return 3;
        }

        return 6;
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
