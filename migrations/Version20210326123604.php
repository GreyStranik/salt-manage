<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210326123604 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Принтеры и МФУ';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "equipment"."printer" (id UUID NOT NULL, model_id UUID NOT NULL, serial TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9BCD270C7975B7E7 ON "equipment"."printer" (model_id)');
        $this->addSql('COMMENT ON COLUMN "equipment"."printer".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "equipment"."printer".model_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "equipment"."printer_model" (id UUID NOT NULL, vendor_id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2CEFCCE05E237E06 ON "equipment"."printer_model" (name)');
        $this->addSql('CREATE INDEX IDX_2CEFCCE0F603EE73 ON "equipment"."printer_model" (vendor_id)');
        $this->addSql('COMMENT ON COLUMN "equipment"."printer_model".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "equipment"."printer_model".vendor_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE connected_printers (id UUID NOT NULL, minion_id UUID NOT NULL, printer_id UUID NOT NULL, connected BOOLEAN NOT NULL, cdate TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1CAA7482968DC69 ON connected_printers (minion_id)');
        $this->addSql('CREATE INDEX IDX_1CAA74846EC494A ON connected_printers (printer_id)');
        $this->addSql('COMMENT ON COLUMN connected_printers.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN connected_printers.minion_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN connected_printers.printer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE "equipment"."printer" ADD CONSTRAINT FK_9BCD270C7975B7E7 FOREIGN KEY (model_id) REFERENCES "equipment"."printer_model" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "equipment"."printer_model" ADD CONSTRAINT FK_2CEFCCE0F603EE73 FOREIGN KEY (vendor_id) REFERENCES "helpers"."vendor" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE connected_printers ADD CONSTRAINT FK_1CAA7482968DC69 FOREIGN KEY (minion_id) REFERENCES minion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE connected_printers ADD CONSTRAINT FK_1CAA74846EC494A FOREIGN KEY (printer_id) REFERENCES "equipment"."printer" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE connected_printers DROP CONSTRAINT FK_1CAA74846EC494A');
        $this->addSql('ALTER TABLE "equipment"."printer" DROP CONSTRAINT FK_9BCD270C7975B7E7');
        $this->addSql('DROP TABLE "equipment"."printer"');
        $this->addSql('DROP TABLE "equipment"."printer_model"');
        $this->addSql('DROP TABLE connected_printers');
    }
}
