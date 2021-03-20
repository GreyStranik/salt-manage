<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210320200641 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Состояния миньена';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "helpers"."state" (id UUID NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3AE40CDE5E237E06 ON "helpers"."state" (name)');
        $this->addSql('COMMENT ON COLUMN "helpers"."state".id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE assigned_states (id UUID NOT NULL, minion_id UUID NOT NULL, state_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A9D4DFC32968DC69 ON assigned_states (minion_id)');
        $this->addSql('CREATE INDEX IDX_A9D4DFC35D83CC1 ON assigned_states (state_id)');
        $this->addSql('COMMENT ON COLUMN assigned_states.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN assigned_states.minion_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN assigned_states.state_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE assigned_states ADD CONSTRAINT FK_A9D4DFC32968DC69 FOREIGN KEY (minion_id) REFERENCES minion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE assigned_states ADD CONSTRAINT FK_A9D4DFC35D83CC1 FOREIGN KEY (state_id) REFERENCES "helpers"."state" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE assigned_states DROP CONSTRAINT FK_A9D4DFC35D83CC1');
        $this->addSql('DROP TABLE "helpers"."state"');
        $this->addSql('DROP TABLE assigned_states');
    }
}
