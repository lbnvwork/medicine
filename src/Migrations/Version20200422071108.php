<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422071108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE patient_diagnosis (patient_id INT NOT NULL, diagnosis_id INT NOT NULL, PRIMARY KEY(patient_id, diagnosis_id))');
        $this->addSql('CREATE INDEX IDX_D85ADD026B899279 ON patient_diagnosis (patient_id)');
        $this->addSql('CREATE INDEX IDX_D85ADD023CBE4D00 ON patient_diagnosis (diagnosis_id)');
        $this->addSql('COMMENT ON COLUMN patient_diagnosis.patient_id IS \'Ключ пациента\'');
        $this->addSql('COMMENT ON COLUMN patient_diagnosis.diagnosis_id IS \'Ключ записи\'');
        $this->addSql(
            'ALTER TABLE patient_diagnosis ADD CONSTRAINT FK_D85ADD026B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
        $this->addSql(
            'ALTER TABLE patient_diagnosis ADD CONSTRAINT FK_D85ADD023CBE4D00 FOREIGN KEY (diagnosis_id) REFERENCES diagnosis (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP TABLE patient_diagnosis');
    }
}
