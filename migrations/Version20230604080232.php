<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230604080232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ecotone_deduplication (message_id VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, consumer_endpoint_id VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, routing_slip VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, handled_at BIGINT NOT NULL, INDEX IDX_4FEBE3E36F4B26C (handled_at), PRIMARY KEY(message_id, consumer_endpoint_id, routing_slip)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE enqueue (id CHAR(36) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci` COMMENT \'(DC2Type:guid)\', published_at BIGINT NOT NULL, body LONGTEXT CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, headers LONGTEXT CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, properties LONGTEXT CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, redelivered TINYINT(1) DEFAULT NULL, queue VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, priority SMALLINT DEFAULT NULL, delayed_until BIGINT DEFAULT NULL, time_to_live BIGINT DEFAULT NULL, delivery_id CHAR(36) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci` COMMENT \'(DC2Type:guid)\', redeliver_after BIGINT DEFAULT NULL, INDEX IDX_CFC35A68AA0BDFF712136921 (redeliver_after, delivery_id), INDEX IDX_CFC35A6812136921 (delivery_id), INDEX IDX_CFC35A68E0669C0612136921 (time_to_live, delivery_id), INDEX IDX_CFC35A6862A6DC27E0D4FDE17FFD7F63121369211A065DF8BF396750 (priority, published_at, queue, delivery_id, delayed_until, id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ecotone_document_store (collection VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, document_id VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, document_type LONGTEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, document JSON NOT NULL, updated_at DOUBLE PRECISION NOT NULL, PRIMARY KEY(collection, document_id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ecotone_deduplication');
        $this->addSql('DROP TABLE enqueue');
        $this->addSql('DROP TABLE ecotone_document_store');
    }
}
