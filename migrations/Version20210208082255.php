<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208082255 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Информация о типе и месте размещения АРМ';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE minion ADD type_id UUID NOT NULL');
        $this->addSql('ALTER TABLE minion ADD type_dep_id UUID NOT NULL');
        $this->addSql('ALTER TABLE minion ADD department_id UUID NOT NULL');
        $this->addSql('COMMENT ON COLUMN minion.type_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN minion.type_dep_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN minion.department_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE minion ADD CONSTRAINT FK_451AE3B3C54C8C93 FOREIGN KEY (type_id) REFERENCES "helpers"."type" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minion ADD CONSTRAINT FK_451AE3B3A29DC354 FOREIGN KEY (type_dep_id) REFERENCES "helpers"."type_dep" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minion ADD CONSTRAINT FK_451AE3B3AE80F5DF FOREIGN KEY (department_id) REFERENCES "helpers"."department" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_451AE3B3C54C8C93 ON minion (type_id)');
        $this->addSql('CREATE INDEX IDX_451AE3B3A29DC354 ON minion (type_dep_id)');
        $this->addSql('CREATE INDEX IDX_451AE3B3AE80F5DF ON minion (department_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE minion DROP CONSTRAINT FK_451AE3B3C54C8C93');
        $this->addSql('ALTER TABLE minion DROP CONSTRAINT FK_451AE3B3A29DC354');
        $this->addSql('ALTER TABLE minion DROP CONSTRAINT FK_451AE3B3AE80F5DF');
        $this->addSql('DROP INDEX IDX_451AE3B3C54C8C93');
        $this->addSql('DROP INDEX IDX_451AE3B3A29DC354');
        $this->addSql('DROP INDEX IDX_451AE3B3AE80F5DF');
        $this->addSql('ALTER TABLE minion DROP type_id');
        $this->addSql('ALTER TABLE minion DROP type_dep_id');
        $this->addSql('ALTER TABLE minion DROP department_id');
    }
}
