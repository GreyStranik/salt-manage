<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402123113 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'MEGA SEARCH';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE INDEX idx_node_name ON minion USING btree ( upper(node_name) TEXT_PATTERN_OPS )');
        $this->addSql('CREATE INDEX idx_soft_name
                            ON helpers.soft USING btree
                            (upper(name) text_pattern_ops ASC NULLS LAST)');
        $this->addSql('CREATE INDEX idx_monitor_serial ON equipment.monitor USING btree ( upper(serial) TEXT_PATTERN_OPS )');
        $this->addSql('CREATE INDEX idx_printer_serial ON equipment.printer USING btree ( upper(serial) TEXT_PATTERN_OPS ) ');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX idx_node_name');
        $this->addSql('DROP INDEX helpers.idx_soft_name');
        $this->addSql('DROP INDEX equipment.idx_monitor_serial');
        $this->addSql('DROP INDEX equipment.idx_printer_serial');
    }
}
