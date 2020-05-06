<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200505175740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE patient_testing_result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE patient_testing_result (id INT NOT NULL, patient_testing_id INT NOT NULL, analysis_rate_id INT NOT NULL, result DOUBLE PRECISION NOT NULL, enabled BOOLEAN DEFAULT \'true\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_82D2CA2AB0EC09FD ON patient_testing_result (patient_testing_id)');
        $this->addSql('CREATE INDEX IDX_82D2CA2AC648F999 ON patient_testing_result (analysis_rate_id)');
        $this->addSql('COMMENT ON COLUMN patient_testing_result.patient_testing_id IS \'Ключ сдачи анализов\'');
        $this->addSql('COMMENT ON COLUMN patient_testing_result.analysis_rate_id IS \'Ключ нормальных значений\'');
        $this->addSql('COMMENT ON COLUMN patient_testing_result.result IS \'Результат анализа\'');
        $this->addSql('COMMENT ON COLUMN patient_testing_result.enabled IS \'Ограничение использования\'');
        $this->addSql('ALTER TABLE patient_testing_result ADD CONSTRAINT FK_82D2CA2AB0EC09FD FOREIGN KEY (patient_testing_id) REFERENCES patient_testing (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient_testing_result ADD CONSTRAINT FK_82D2CA2AC648F999 FOREIGN KEY (analysis_rate_id) REFERENCES analysis_rate (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('COMMENT ON COLUMN patient_testing.id IS \'Ключ сдачи анализов\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE patient_testing_result_id_seq CASCADE');
        $this->addSql('DROP TABLE patient_testing_result');
        $this->addSql('COMMENT ON COLUMN patient_testing.id IS NULL');
    }
}
