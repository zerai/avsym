<?php declare(strict_types=1);

namespace Publishing\Cms\Infrastructure\ItOps;

use Ecotone\Dbal\Configuration\DbalConfiguration;
use Ecotone\Dbal\DbalBackedMessageChannelBuilder;
use Ecotone\Messaging\Attribute\ServiceContext;
use Ecotone\Messaging\Endpoint\PollingMetadata;

class CmsEcotoneConfiguration
{
    public const ASYNCHRONOUS_CHANNEL = "cms_asynchronous_channel";

    #[ServiceContext]
    public function asynchronous_messages()
    {
        return [
            //            DbalBackedMessageChannelBuilder::create(self::ASYNCHRONOUS_CHANNEL),
            //            PollingMetadata::create(self::ASYNCHRONOUS_CHANNEL)
            //                ->setStopOnError(true)
            //                ->setExecutionTimeLimitInMilliseconds(1000)
        ];
    }

    #[ServiceContext]
    public function documentStoreRepository()
    {
        //        return DbalConfiguration::createWithDefaults()
        //            ->withDocumentStore(enableDocumentStoreAggregateRepository: true);

        return [];
    }
}
