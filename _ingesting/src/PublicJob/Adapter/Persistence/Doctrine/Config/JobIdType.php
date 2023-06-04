<?php

namespace Ingesting\PublicJob\Adapter\Persistence\Doctrine\Config;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\GuidType;
use Ingesting\PublicJob\Application\Model\JobId;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Throwable;

class JobIdType extends GuidType
{
    public const NAME = 'job_id';

    /**
     * {@inheritdoc}
     *
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?JobId
    {
        if ($value instanceof UuidInterface) {
            return $value;
        }

        if (!is_string($value) || $value === '') {
            return null;
        }

        try {
            $uuid = JobId::fromString($value);//Uuid::fromString($value);
        } catch (Throwable $e) {
            throw ConversionException::conversionFailed($value, self::NAME);
        }

        return $uuid;
    }

    /**
     * {@inheritdoc}
     *
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (
            $value instanceof UuidInterface
            || (
                (is_string($value)
                    || (is_object($value) && method_exists($value, '__toString')))
                && Uuid::isValid((string) $value)
            )
        ) {
            return (string) $value;
        }

        throw ConversionException::conversionFailed($value, self::NAME);
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function getMappedDatabaseTypes(AbstractPlatform $platform): array
    {
        return [self::NAME];
    }


}