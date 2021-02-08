<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208065837 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Таблица продуктов';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_name (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D3CB5CA75E237E06 ON product_name (name)');
        $this->addSql('COMMENT ON COLUMN product_name.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE minion ADD product_name_id UUID NOT NULL');
        $this->addSql('COMMENT ON COLUMN minion.product_name_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE minion ADD CONSTRAINT FK_451AE3B3A0CE8766 FOREIGN KEY (product_name_id) REFERENCES product_name (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_451AE3B3A0CE8766 ON minion (product_name_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE minion DROP CONSTRAINT FK_451AE3B3A0CE8766');
        $this->addSql('DROP TABLE product_name');
        $this->addSql('DROP INDEX IDX_451AE3B3A0CE8766');
        $this->addSql('ALTER TABLE minion DROP product_name_id');
    }
}
