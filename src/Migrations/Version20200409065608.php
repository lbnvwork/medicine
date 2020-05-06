<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200409065608 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE patient DROP CONSTRAINT fk_1adad7eb6bf700bd');
        $this->addSql('DROP INDEX idx_1adad7eb6bf700bd');
        $this->addSql('ALTER TABLE patient DROP status_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('ALTER TABLE patient ADD status_id INT NOT NULL');
        $this->addSql('COMMENT ON COLUMN patient.status_id IS \'Ключ статуса\'');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT fk_1adad7eb6bf700bd FOREIGN KEY (status_id) REFERENCES patient_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1adad7eb6bf700bd ON patient (status_id)');
    }
}
