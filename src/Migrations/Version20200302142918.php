<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200302142918 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE country_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE country (id INT NOT NULL, name VARCHAR(30) NOT NULL, shortcode VARCHAR(4) NOT NULL, enabled INT DEFAULT 1 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN country.id IS \'Ключ страны\'');
        $this->addSql('COMMENT ON COLUMN country.name IS \'Название страны\'');
        $this->addSql('COMMENT ON COLUMN country.shortcode IS \'Код страны в формате ISO\'');
        $this->addSql('COMMENT ON COLUMN country.enabled IS \'Ограничение использования\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE country_id_seq CASCADE');
        $this->addSql('DROP TABLE country');
    }
}
