<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200303125823 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE medicine_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE medicine (id INT NOT NULL, name VARCHAR(50) NOT NULL, description TEXT NOT NULL, enabled INT DEFAULT 1 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN medicine.id IS \'Ключ препарата\'');
        $this->addSql('COMMENT ON COLUMN medicine.name IS \'Название препарата\'');
        $this->addSql('COMMENT ON COLUMN medicine.description IS \'Описание использования\'');
        $this->addSql('COMMENT ON COLUMN medicine.enabled IS \'Ограничение использования\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE medicine_id_seq CASCADE');
        $this->addSql('DROP TABLE medicine');
    }
}
