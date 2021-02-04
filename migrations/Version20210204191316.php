<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204191316 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE manufacturer (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D0AE6DC5E237E06 ON manufacturer (name)');
        $this->addSql('COMMENT ON COLUMN manufacturer.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE minion ADD manufacturer_id UUID NOT NULL');
        $this->addSql('COMMENT ON COLUMN minion.manufacturer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE minion ADD CONSTRAINT FK_451AE3B3A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_451AE3B3A23B42D ON minion (manufacturer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE minion DROP CONSTRAINT FK_451AE3B3A23B42D');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('DROP INDEX IDX_451AE3B3A23B42D');
        $this->addSql('ALTER TABLE minion DROP manufacturer_id');
    }
}
