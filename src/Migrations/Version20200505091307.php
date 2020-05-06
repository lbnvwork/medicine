<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200505091307 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE patient_testing_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE patient_testing (id INT NOT NULL, patient_id INT NOT NULL, analysis_group_id INT NOT NULL, analysis_date DATE DEFAULT NULL, gestational_min_age INT NOT NULL, gestational_max_age INT NOT NULL, processed BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B5900FED6B899279 ON patient_testing (patient_id)');
        $this->addSql('CREATE INDEX IDX_B5900FED174DAD14 ON patient_testing (analysis_group_id)');
        $this->addSql('COMMENT ON COLUMN patient_testing.patient_id IS \'Ключ пациента\'');
        $this->addSql('COMMENT ON COLUMN patient_testing.analysis_group_id IS \'Ключ группы анализов\'');
        $this->addSql('COMMENT ON COLUMN patient_testing.analysis_date IS \'Дата проведенного тестирования\'');
        $this->addSql('COMMENT ON COLUMN patient_testing.gestational_min_age IS \'Срок гестации для начала сдачи анализа\'');
        $this->addSql('COMMENT ON COLUMN patient_testing.gestational_max_age IS \'Срок гестации для окончания сдачи анализа\'');
        $this->addSql('COMMENT ON COLUMN patient_testing.processed IS \'Статус принятия в работу врачом\'');
        $this->addSql('ALTER TABLE patient_testing ADD CONSTRAINT FK_B5900FED6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient_testing ADD CONSTRAINT FK_B5900FED174DAD14 FOREIGN KEY (analysis_group_id) REFERENCES analysis_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE patient_testing_id_seq CASCADE');
        $this->addSql('DROP TABLE patient_testing');
    }
}
