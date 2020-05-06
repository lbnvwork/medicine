<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200407162949 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE patient DROP CONSTRAINT fk_1adad7eb3cbe4d00');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT fk_1adad7eb2f7d140a');
        $this->addSql('DROP INDEX idx_1adad7eb3cbe4d00');
        $this->addSql('DROP INDEX idx_1adad7eb2f7d140a');
        $this->addSql('ALTER TABLE patient DROP diagnosis_id');
        $this->addSql('ALTER TABLE patient DROP medicine_id');
        $this->addSql('ALTER TABLE patient DROP mno');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('ALTER TABLE patient ADD diagnosis_id INT NOT NULL');
        $this->addSql('ALTER TABLE patient ADD medicine_id INT NOT NULL');
        $this->addSql('ALTER TABLE patient ADD mno DOUBLE PRECISION NOT NULL');
        $this->addSql('COMMENT ON COLUMN patient.diagnosis_id IS \'Ключ записи\'');
        $this->addSql('COMMENT ON COLUMN patient.medicine_id IS \'Ключ препарата\'');
        $this->addSql('COMMENT ON COLUMN patient.mno IS \'Значение МНО\'');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT fk_1adad7eb3cbe4d00 FOREIGN KEY (diagnosis_id) REFERENCES diagnosis (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT fk_1adad7eb2f7d140a FOREIGN KEY (medicine_id) REFERENCES medicine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1adad7eb3cbe4d00 ON patient (diagnosis_id)');
        $this->addSql('CREATE INDEX idx_1adad7eb2f7d140a ON patient (medicine_id)');
    }
}
