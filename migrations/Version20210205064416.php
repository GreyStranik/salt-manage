<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210205064416 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA helpers');
        $this->addSql('ALTER TABLE minion DROP CONSTRAINT fk_451ae3b3a23b42d');
        $this->addSql('CREATE TABLE "helpers"."manufacturer" (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3011F495E237E06 ON "helpers"."manufacturer" (name)');
        $this->addSql('COMMENT ON COLUMN "helpers"."manufacturer".id IS \'(DC2Type:uuid)\'');
        $this->addSql('DROP TABLE manufacturer');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE minion DROP CONSTRAINT FK_451AE3B3A23B42D');
        $this->addSql('CREATE TABLE manufacturer (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_3d0ae6dc5e237e06 ON manufacturer (name)');
        $this->addSql('COMMENT ON COLUMN manufacturer.id IS \'(DC2Type:uuid)\'');
        $this->addSql('DROP TABLE "helpers"."manufacturer"');
    }
}
