<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210326060836 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Мониторы';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA equipment');
        $this->addSql('CREATE TABLE "equipment"."monitor" (id UUID NOT NULL, model_id UUID NOT NULL, serial TEXT NOT NULL, year INT NOT NULL, week INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F794C7647975B7E7 ON "equipment"."monitor" (model_id)');
        $this->addSql('COMMENT ON COLUMN "equipment"."monitor".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "equipment"."monitor".model_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "equipment"."monitor_models" (id UUID NOT NULL, vendor_id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_51C63EBEF603EE73 ON "equipment"."monitor_models" (vendor_id)');
        $this->addSql('COMMENT ON COLUMN "equipment"."monitor_models".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "equipment"."monitor_models".vendor_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "helpers"."vendor" (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BEBF906F5E237E06 ON "helpers"."vendor" (name)');
        $this->addSql('COMMENT ON COLUMN "helpers"."vendor".id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE connected_monitors (id UUID NOT NULL, minion_id UUID NOT NULL, monitor_id UUID NOT NULL, connected BOOLEAN NOT NULL, cdate TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42CF17C22968DC69 ON connected_monitors (minion_id)');
        $this->addSql('CREATE INDEX IDX_42CF17C24CE1C902 ON connected_monitors (monitor_id)');
        $this->addSql('COMMENT ON COLUMN connected_monitors.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN connected_monitors.minion_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN connected_monitors.monitor_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE "equipment"."monitor" ADD CONSTRAINT FK_F794C7647975B7E7 FOREIGN KEY (model_id) REFERENCES "equipment"."monitor_models" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "equipment"."monitor_models" ADD CONSTRAINT FK_51C63EBEF603EE73 FOREIGN KEY (vendor_id) REFERENCES "helpers"."vendor" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE connected_monitors ADD CONSTRAINT FK_42CF17C22968DC69 FOREIGN KEY (minion_id) REFERENCES minion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE connected_monitors ADD CONSTRAINT FK_42CF17C24CE1C902 FOREIGN KEY (monitor_id) REFERENCES "equipment"."monitor" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE connected_monitors DROP CONSTRAINT FK_42CF17C24CE1C902');
        $this->addSql('ALTER TABLE "equipment"."monitor" DROP CONSTRAINT FK_F794C7647975B7E7');
        $this->addSql('ALTER TABLE "equipment"."monitor_models" DROP CONSTRAINT FK_51C63EBEF603EE73');
        $this->addSql('DROP TABLE "equipment"."monitor"');
        $this->addSql('DROP TABLE "equipment"."monitor_models"');
        $this->addSql('DROP TABLE "helpers"."vendor"');
        $this->addSql('DROP TABLE connected_monitors');
    }
}
