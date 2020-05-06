<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200302145000 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE region_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE region (id INT NOT NULL, country_id_id INT NOT NULL, name VARCHAR(50) NOT NULL, region_number VARCHAR(8) NOT NULL, enabled INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F62F176D8A48BBD ON region (country_id_id)');
        $this->addSql('COMMENT ON COLUMN region.country_id_id IS \'Ключ страны\'');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F176D8A48BBD FOREIGN KEY (country_id_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE region_id_seq CASCADE');
        $this->addSql('DROP TABLE region');
    }
}
