<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200303130106 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE patient ADD medicine_id INT NOT NULL');
        $this->addSql('COMMENT ON COLUMN patient.medicine_id IS \'Ключ препарата\'');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB2F7D140A FOREIGN KEY (medicine_id) REFERENCES medicine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB2F7D140A ON patient (medicine_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EB2F7D140A');
        $this->addSql('DROP INDEX IDX_1ADAD7EB2F7D140A');
        $this->addSql('ALTER TABLE patient DROP medicine_id');
    }
}
