<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208074043 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE minion ADD fio_user TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE minion ADD user_phone TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE minion ADD CONSTRAINT FK_451AE3B3A0CE8766 FOREIGN KEY (product_name_id) REFERENCES "helpers"."product_name" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE minion DROP CONSTRAINT FK_451AE3B3A0CE8766');
        $this->addSql('ALTER TABLE minion DROP fio_user');
        $this->addSql('ALTER TABLE minion DROP user_phone');
    }
}
