<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209112546 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "helpers"."soft" (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_105BA745E237E06 ON "helpers"."soft" (name)');
        $this->addSql('COMMENT ON COLUMN "helpers"."soft".id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE installed_software (id UUID NOT NULL, minion_id UUID NOT NULL, soft_id UUID NOT NULL, size BIGINT DEFAULT NULL, version TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DEC9834E2968DC69 ON installed_software (minion_id)');
        $this->addSql('CREATE INDEX IDX_DEC9834ED2610143 ON installed_software (soft_id)');
        $this->addSql('CREATE INDEX idx_installed_software_version ON installed_software (version)');
        $this->addSql('COMMENT ON COLUMN installed_software.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN installed_software.minion_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN installed_software.soft_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE installed_software ADD CONSTRAINT FK_DEC9834E2968DC69 FOREIGN KEY (minion_id) REFERENCES minion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE installed_software ADD CONSTRAINT FK_DEC9834ED2610143 FOREIGN KEY (soft_id) REFERENCES "helpers"."soft" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE installed_software DROP CONSTRAINT FK_DEC9834ED2610143');
        $this->addSql('DROP TABLE "helpers"."soft"');
        $this->addSql('DROP TABLE installed_software');
    }
}
