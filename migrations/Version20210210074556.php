<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210210074556 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Информация об операционной системе';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "helpers"."os" (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "helpers"."os".id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "helpers"."os_full_name" (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "helpers"."os_full_name".id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE minion ADD os_id UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE minion ADD os_full_name_id UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE minion ADD osrelease TEXT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN minion.os_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN minion.os_full_name_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE minion ADD CONSTRAINT FK_451AE3B33DCA04D1 FOREIGN KEY (os_id) REFERENCES "helpers"."os" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minion ADD CONSTRAINT FK_451AE3B3207AF296 FOREIGN KEY (os_full_name_id) REFERENCES "helpers"."os_full_name" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_451AE3B33DCA04D1 ON minion (os_id)');
        $this->addSql('CREATE INDEX IDX_451AE3B3207AF296 ON minion (os_full_name_id)');
        $this->addSql('CREATE INDEX idx_minion_os_release ON minion (osrelease)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE minion DROP CONSTRAINT FK_451AE3B33DCA04D1');
        $this->addSql('ALTER TABLE minion DROP CONSTRAINT FK_451AE3B3207AF296');
        $this->addSql('DROP TABLE "helpers"."os"');
        $this->addSql('DROP TABLE "helpers"."os_full_name"');
        $this->addSql('DROP INDEX IDX_451AE3B33DCA04D1');
        $this->addSql('DROP INDEX IDX_451AE3B3207AF296');
        $this->addSql('DROP INDEX idx_minion_os_release');
        $this->addSql('ALTER TABLE minion DROP os_id');
        $this->addSql('ALTER TABLE minion DROP os_full_name_id');
        $this->addSql('ALTER TABLE minion DROP osrelease');
    }
}
