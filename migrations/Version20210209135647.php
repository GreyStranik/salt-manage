<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209135647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Сведения о дисках';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE disk (id UUID NOT NULL, minion_id UUID NOT NULL, name TEXT NOT NULL, used BIGINT NOT NULL, available BIGINT NOT NULL, blocks BIGINT NOT NULL, filesystem TEXT NOT NULL, capacity TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C74DD022968DC69 ON disk (minion_id)');
        $this->addSql('CREATE INDEX idx_disk_name ON disk (name)');
        $this->addSql('COMMENT ON COLUMN disk.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN disk.minion_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE disk ADD CONSTRAINT FK_C74DD022968DC69 FOREIGN KEY (minion_id) REFERENCES minion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE disk');
    }
}
