<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429145848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE patient_risk_factor (patient_id INT NOT NULL, risk_factor_id INT NOT NULL, PRIMARY KEY(patient_id, risk_factor_id))');
        $this->addSql('CREATE INDEX IDX_1DF0DD2B6B899279 ON patient_risk_factor (patient_id)');
        $this->addSql('CREATE INDEX IDX_1DF0DD2B61639429 ON patient_risk_factor (risk_factor_id)');
        $this->addSql('COMMENT ON COLUMN patient_risk_factor.patient_id IS \'Ключ пациента\'');
        $this->addSql('ALTER TABLE patient_risk_factor ADD CONSTRAINT FK_1DF0DD2B6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient_risk_factor ADD CONSTRAINT FK_1DF0DD2B61639429 FOREIGN KEY (risk_factor_id) REFERENCES risk_factor (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP TABLE patient_risk_factor');
    }
}
