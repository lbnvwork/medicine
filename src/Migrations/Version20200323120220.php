<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323120220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE city ADD oktmo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234EE0C723D FOREIGN KEY (oktmo_id) REFERENCES oktmo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2D5B0234EE0C723D ON city (oktmo_id)');
        $this->addSql('ALTER TABLE district ADD oktmo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE district ADD CONSTRAINT FK_31C15487EE0C723D FOREIGN KEY (oktmo_id) REFERENCES oktmo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_31C15487EE0C723D ON district (oktmo_id)');
        $this->addSql('ALTER TABLE lpu RENAME COLUMN oktmo_id TO oktmo_region_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE district DROP CONSTRAINT FK_31C15487EE0C723D');
        $this->addSql('DROP INDEX UNIQ_31C15487EE0C723D');
        $this->addSql('ALTER TABLE district DROP oktmo_id');
        $this->addSql('ALTER TABLE lpu RENAME COLUMN oktmo_region_id TO oktmo_id');
        $this->addSql('ALTER TABLE city DROP CONSTRAINT FK_2D5B0234EE0C723D');
        $this->addSql('DROP INDEX UNIQ_2D5B0234EE0C723D');
        $this->addSql('ALTER TABLE city DROP oktmo_id');
    }
}
