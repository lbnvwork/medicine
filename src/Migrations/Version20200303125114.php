<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200303125114 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE patient_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE patient (id INT NOT NULL, region_id INT NOT NULL, hospital_id INT NOT NULL, gender_id INT NOT NULL, diagnosis_id INT NOT NULL, first_name VARCHAR(30) NOT NULL, last_name VARCHAR(30) NOT NULL, patronymic_name VARCHAR(30) DEFAULT NULL, phone VARCHAR(12) NOT NULL, email VARCHAR(60) DEFAULT NULL, password VARCHAR(50) DEFAULT NULL, snils VARCHAR(20) DEFAULT NULL, insurance_number VARCHAR(50) DEFAULT NULL, date_birth DATE DEFAULT NULL, date_start_of_treatment DATE NOT NULL, address VARCHAR(255) NOT NULL, sms_informing INT DEFAULT 1 NOT NULL, email_informing INT DEFAULT 1 NOT NULL, description TEXT DEFAULT NULL, important_comment TEXT DEFAULT NULL, status INT NOT NULL, mno DOUBLE PRECISION NOT NULL, concomitant_disease TEXT NOT NULL, passport VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB98260155 ON patient (region_id)');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB63DBB69 ON patient (hospital_id)');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB708A0E0 ON patient (gender_id)');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB3CBE4D00 ON patient (diagnosis_id)');
        $this->addSql('COMMENT ON COLUMN patient.id IS \'Ключ пациента\'');
        $this->addSql('COMMENT ON COLUMN patient.region_id IS \'Ключ региона\'');
        $this->addSql('COMMENT ON COLUMN patient.hospital_id IS \'Ключ больницы\'');
        $this->addSql('COMMENT ON COLUMN patient.gender_id IS \'Ключ пола\'');
        $this->addSql('COMMENT ON COLUMN patient.diagnosis_id IS \'Ключ записи\'');
        $this->addSql('COMMENT ON COLUMN patient.first_name IS \'Имя пациента\'');
        $this->addSql('COMMENT ON COLUMN patient.last_name IS \'Фамилия пациента\'');
        $this->addSql('COMMENT ON COLUMN patient.patronymic_name IS \'Отчество пациента\'');
        $this->addSql('COMMENT ON COLUMN patient.phone IS \'Телефон пациента\'');
        $this->addSql('COMMENT ON COLUMN patient.email IS \'Email пациента\'');
        $this->addSql('COMMENT ON COLUMN patient.password IS \'Пароль\'');
        $this->addSql('COMMENT ON COLUMN patient.snils IS \'СНИЛС пациента\'');
        $this->addSql('COMMENT ON COLUMN patient.insurance_number IS \'Номер страховки\'');
        $this->addSql('COMMENT ON COLUMN patient.date_birth IS \'Дата рождения\'');
        $this->addSql('COMMENT ON COLUMN patient.date_start_of_treatment IS \'Дата начала лечения\'');
        $this->addSql('COMMENT ON COLUMN patient.address IS \'Адрес пациента\'');
        $this->addSql('COMMENT ON COLUMN patient.sms_informing IS \'Флаг оповещения через смс\'');
        $this->addSql('COMMENT ON COLUMN patient.email_informing IS \'Флаг оповещения через email\'');
        $this->addSql('COMMENT ON COLUMN patient.description IS \'Описание/комментарий\'');
        $this->addSql('COMMENT ON COLUMN patient.important_comment IS \'Важный комментарий для вывода\'');
        $this->addSql('COMMENT ON COLUMN patient.status IS \'Статус пациента\'');
        $this->addSql('COMMENT ON COLUMN patient.mno IS \'Значение МНО\'');
        $this->addSql('COMMENT ON COLUMN patient.concomitant_disease IS \'Сопуствующее заболевание\'');
        $this->addSql('COMMENT ON COLUMN patient.passport IS \'Паспортный данные\'');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB98260155 FOREIGN KEY (region_id) REFERENCES region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB63DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB3CBE4D00 FOREIGN KEY (diagnosis_id) REFERENCES diagnosis (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE patient_id_seq CASCADE');
        $this->addSql('DROP TABLE patient');
    }
}
