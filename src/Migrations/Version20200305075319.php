<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200305075319 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE staff DROP fio');
        $this->addSql('ALTER TABLE staff DROP email');
        $this->addSql('ALTER TABLE staff DROP password');
        $this->addSql('ALTER TABLE staff DROP phone');
        $this->addSql('ALTER TABLE staff DROP description');
        $this->addSql('ALTER TABLE auth_user ADD phone VARCHAR(12) NOT NULL');
        $this->addSql('ALTER TABLE auth_user ADD first_name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE auth_user ADD last_name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE auth_user ADD patronymic_name VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE auth_user ADD description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient DROP first_name');
        $this->addSql('ALTER TABLE patient DROP last_name');
        $this->addSql('ALTER TABLE patient DROP patronymic_name');
        $this->addSql('ALTER TABLE patient DROP phone');
        $this->addSql('ALTER TABLE patient DROP email');
        $this->addSql('ALTER TABLE patient DROP password');
        $this->addSql('ALTER TABLE patient DROP description');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('ALTER TABLE staff ADD fio VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE staff ADD email VARCHAR(60) NOT NULL');
        $this->addSql('ALTER TABLE staff ADD password VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE staff ADD phone VARCHAR(12) NOT NULL');
        $this->addSql('ALTER TABLE staff ADD description TEXT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN staff.fio IS \'ФИО\'');
        $this->addSql('COMMENT ON COLUMN staff.email IS \'Логин пользователя (email)\'');
        $this->addSql('COMMENT ON COLUMN staff.password IS \'Пароль пользователя\'');
        $this->addSql('COMMENT ON COLUMN staff.phone IS \'Телефон пользователя\'');
        $this->addSql('COMMENT ON COLUMN staff.description IS \'Описание/комментарий\'');
        $this->addSql('ALTER TABLE patient ADD first_name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE patient ADD last_name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE patient ADD patronymic_name VARCHAR(30) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD phone VARCHAR(12) NOT NULL');
        $this->addSql('ALTER TABLE patient ADD email VARCHAR(60) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD password VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD description TEXT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN patient.first_name IS \'Имя пациента\'');
        $this->addSql('COMMENT ON COLUMN patient.last_name IS \'Фамилия пациента\'');
        $this->addSql('COMMENT ON COLUMN patient.patronymic_name IS \'Отчество пациента\'');
        $this->addSql('COMMENT ON COLUMN patient.phone IS \'Телефон пациента\'');
        $this->addSql('COMMENT ON COLUMN patient.email IS \'Email пациента\'');
        $this->addSql('COMMENT ON COLUMN patient.password IS \'Пароль\'');
        $this->addSql('COMMENT ON COLUMN patient.description IS \'Описание/комментарий\'');
        $this->addSql('ALTER TABLE auth_user DROP phone');
        $this->addSql('ALTER TABLE auth_user DROP first_name');
        $this->addSql('ALTER TABLE auth_user DROP last_name');
        $this->addSql('ALTER TABLE auth_user DROP patronymic_name');
        $this->addSql('ALTER TABLE auth_user DROP description');
    }
}
