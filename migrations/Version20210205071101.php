<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210205071101 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Creating cpu_model tables';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "helpers"."cpu_model" (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_84DE7BD25E237E06 ON "helpers"."cpu_model" (name)');
        $this->addSql('COMMENT ON COLUMN "helpers"."cpu_model".id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE minion ADD cpu_model_id UUID NOT NULL');
        $this->addSql('COMMENT ON COLUMN minion.cpu_model_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE minion ADD CONSTRAINT FK_451AE3B3A23B42D FOREIGN KEY (manufacturer_id) REFERENCES "helpers"."manufacturer" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minion ADD CONSTRAINT FK_451AE3B37BE78291 FOREIGN KEY (cpu_model_id) REFERENCES "helpers"."cpu_model" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_451AE3B37BE78291 ON minion (cpu_model_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE minion DROP CONSTRAINT FK_451AE3B37BE78291');
        $this->addSql('DROP TABLE "helpers"."cpu_model"');
        $this->addSql('ALTER TABLE minion DROP CONSTRAINT FK_451AE3B3A23B42D');
        $this->addSql('DROP INDEX IDX_451AE3B37BE78291');
        $this->addSql('ALTER TABLE minion DROP cpu_model_id');
    }
}
