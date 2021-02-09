<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209064236 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Хранение сети компьютера';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ips (id UUID NOT NULL, network_id UUID NOT NULL, ip_address inet NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5E7470CD34128B91 ON ips (network_id)');
        $this->addSql('COMMENT ON COLUMN ips.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN ips.network_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE network (id UUID NOT NULL, minion_id UUID NOT NULL, interface TEXT NOT NULL, mac_address macaddr NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_608487BC2968DC69 ON network (minion_id)');
        $this->addSql('COMMENT ON COLUMN network.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN network.minion_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE ips ADD CONSTRAINT FK_5E7470CD34128B91 FOREIGN KEY (network_id) REFERENCES network (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE network ADD CONSTRAINT FK_608487BC2968DC69 FOREIGN KEY (minion_id) REFERENCES minion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE ips DROP CONSTRAINT FK_5E7470CD34128B91');
        $this->addSql('DROP TABLE ips');
        $this->addSql('DROP TABLE network');
    }
}
