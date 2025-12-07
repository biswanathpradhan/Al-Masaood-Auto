<?php

namespace Carbon\Doctrine;

<<<<<<< HEAD
use Doctrine\DBAL\Platforms\AbstractPlatform;

class CarbonImmutableType extends DateTimeImmutableType implements CarbonDoctrineType
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getName()
    {
        return 'carbon_immutable';
    }

    /**
     * {@inheritdoc}
     *
     * @return bool
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
=======
class CarbonImmutableType extends DateTimeImmutableType implements CarbonDoctrineType
{
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
