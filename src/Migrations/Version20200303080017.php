<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200303080017 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE staff_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE staff (id INT NOT NULL, role_id INT NOT NULL, hospital_id INT NOT NULL, position_id INT NOT NULL, fio VARCHAR(100) NOT NULL, email VARCHAR(60) NOT NULL, password VARCHAR(50) NOT NULL, phone VARCHAR(12) NOT NULL, description TEXT DEFAULT NULL, enabled INT DEFAULT 1 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_426EF392D60322AC ON staff (role_id)');
        $this->addSql('CREATE INDEX IDX_426EF39263DBB69 ON staff (hospital_id)');
        $this->addSql('CREATE INDEX IDX_426EF392DD842E46 ON staff (position_id)');
        $this->addSql('COMMENT ON COLUMN staff.id IS \'Ключ персонала\'');
        $this->addSql('COMMENT ON COLUMN staff.role_id IS \'Ключ роли\'');
        $this->addSql('COMMENT ON COLUMN staff.hospital_id IS \'Ключ больницы\'');
        $this->addSql('COMMENT ON COLUMN staff.position_id IS \'Ключ должности\'');
        $this->addSql('COMMENT ON COLUMN staff.fio IS \'ФИО\'');
        $this->addSql('COMMENT ON COLUMN staff.email IS \'Логин пользователя (email)\'');
        $this->addSql('COMMENT ON COLUMN staff.password IS \'Пароль пользователя\'');
        $this->addSql('COMMENT ON COLUMN staff.phone IS \'Телефон пользователя\'');
        $this->addSql('COMMENT ON COLUMN staff.description IS \'Описание/комментарий\'');
        $this->addSql('COMMENT ON COLUMN staff.enabled IS \'Ограничение использования\'');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF392D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF39263DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF392DD842E46 FOREIGN KEY (position_id) REFERENCES position (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE staff_id_seq CASCADE');
        $this->addSql('DROP TABLE staff');
    }
}
