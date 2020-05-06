<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200303072354 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE position_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE position (id INT NOT NULL, name VARCHAR(50) NOT NULL, enabled INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN position.id IS \'Ключ должности\'');
        $this->addSql('COMMENT ON COLUMN position.name IS \'Название должности\'');
        $this->addSql('ALTER TABLE hospital ALTER enabled SET DEFAULT 1');
        $this->addSql('COMMENT ON COLUMN hospital.id IS \'Ключ больницы\'');
        $this->addSql('COMMENT ON COLUMN hospital.adress IS \'Адрес больницы\'');
        $this->addSql('COMMENT ON COLUMN hospital.name IS \'Название больницы\'');
        $this->addSql('COMMENT ON COLUMN hospital.phone IS \'Телефон для отправки смс\'');
        $this->addSql('COMMENT ON COLUMN hospital.description IS \'Описание или комментарий для больницы\'');
        $this->addSql('COMMENT ON COLUMN hospital.enabled IS \'Ограничение использования\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE position_id_seq CASCADE');
        $this->addSql('DROP TABLE position');
        $this->addSql('ALTER TABLE hospital ALTER enabled DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN hospital.id IS NULL');
        $this->addSql('COMMENT ON COLUMN hospital.adress IS NULL');
        $this->addSql('COMMENT ON COLUMN hospital.name IS NULL');
        $this->addSql('COMMENT ON COLUMN hospital.phone IS NULL');
        $this->addSql('COMMENT ON COLUMN hospital.description IS NULL');
        $this->addSql('COMMENT ON COLUMN hospital.enabled IS NULL');
    }
}
