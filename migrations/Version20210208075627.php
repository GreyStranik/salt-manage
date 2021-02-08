<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208075627 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Справочники подразделений и типа компьютера';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "helpers"."department" (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F38AC0D25E237E06 ON "helpers"."department" (name)');
        $this->addSql('COMMENT ON COLUMN "helpers"."department".id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "helpers"."type" (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F251C82A5E237E06 ON "helpers"."type" (name)');
        $this->addSql('COMMENT ON COLUMN "helpers"."type".id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "helpers"."type_dep" (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_155B3A4D5E237E06 ON "helpers"."type_dep" (name)');
        $this->addSql('COMMENT ON COLUMN "helpers"."type_dep".id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE "helpers"."department"');
        $this->addSql('DROP TABLE "helpers"."type"');
        $this->addSql('DROP TABLE "helpers"."type_dep"');
    }
}
