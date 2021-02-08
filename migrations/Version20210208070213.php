<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208070213 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE minion DROP CONSTRAINT fk_451ae3b3a0ce8766');
        $this->addSql('CREATE TABLE "helpers"."product_name" (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EDC0A5325E237E06 ON "helpers"."product_name" (name)');
        $this->addSql('COMMENT ON COLUMN "helpers"."product_name".id IS \'(DC2Type:uuid)\'');
        $this->addSql('DROP TABLE product_name');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE minion DROP CONSTRAINT FK_451AE3B3A0CE8766');
        $this->addSql('CREATE TABLE product_name (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_d3cb5ca75e237e06 ON product_name (name)');
        $this->addSql('COMMENT ON COLUMN product_name.id IS \'(DC2Type:uuid)\'');
        $this->addSql('DROP TABLE "helpers"."product_name"');
    }
}
