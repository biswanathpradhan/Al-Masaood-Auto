<?php

namespace Carbon\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;

interface CarbonDoctrineType
{
<<<<<<< HEAD
    public const MAXIMUM_PRECISION = 10;

=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform);

    public function convertToPHPValue($value, AbstractPlatform $platform);

    public function convertToDatabaseValue($value, AbstractPlatform $platform);
}
