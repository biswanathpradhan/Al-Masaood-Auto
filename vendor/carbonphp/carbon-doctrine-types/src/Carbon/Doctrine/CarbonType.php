<?php

namespace Carbon\Doctrine;

<<<<<<< HEAD
use Doctrine\DBAL\Platforms\AbstractPlatform;

class CarbonType extends DateTimeType implements CarbonDoctrineType
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getName()
    {
        return 'carbon';
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
class CarbonType extends DateTimeType implements CarbonDoctrineType
{
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
