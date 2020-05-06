<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200303070435 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE hospital_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE hospital (id INT NOT NULL, region_id INT NOT NULL, city_id INT NOT NULL, adress VARCHAR(255) DEFAULT NULL, name VARCHAR(50) NOT NULL, phone VARCHAR(12) NOT NULL, description TEXT DEFAULT NULL, enabled INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4282C85B98260155 ON hospital (region_id)');
        $this->addSql('CREATE INDEX IDX_4282C85B8BAC62AF ON hospital (city_id)');
        $this->addSql('COMMENT ON COLUMN hospital.region_id IS \'Ключ региона\'');
        $this->addSql('COMMENT ON COLUMN hospital.city_id IS \'Ключ города\'');
        $this->addSql('ALTER TABLE hospital ADD CONSTRAINT FK_4282C85B98260155 FOREIGN KEY (region_id) REFERENCES region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hospital ADD CONSTRAINT FK_4282C85B8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE hospital_id_seq CASCADE');
        $this->addSql('DROP TABLE hospital');
    }
}
