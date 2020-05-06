<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200320111705 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE lpu_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE oktmo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE lpu (id INT NOT NULL, oktmo_id INT DEFAULT NULL, region_name VARCHAR(100) NOT NULL, years VARCHAR(255) NOT NULL, code VARCHAR(6) NOT NULL, full_name VARCHAR(255) DEFAULT NULL, caption VARCHAR(255) NOT NULL, okopf VARCHAR(5) NOT NULL, post_code VARCHAR(6) DEFAULT NULL, address VARCHAR(255) NOT NULL, director_last_name VARCHAR(50) NOT NULL, director_first_name VARCHAR(50) NOT NULL, director_patronymic_name VARCHAR(50) DEFAULT NULL, phone VARCHAR(50) DEFAULT NULL, fax VARCHAR(50) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, license VARCHAR(15) NOT NULL, license_date DATE DEFAULT NULL, license_date_end DATE DEFAULT NULL, medical_care_types VARCHAR(255) NOT NULL, include_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE oktmo (id INT NOT NULL, kod VARCHAR(11) NOT NULL, kod2 VARCHAR(11) NOT NULL, sub_kod1 INT NOT NULL, sub_kod2 INT DEFAULT NULL, sub_cod3 INT NOT NULL, sub_cod4 INT DEFAULT NULL, p1 INT NOT NULL, p2 INT NOT NULL, kch INT NOT NULL, name VARCHAR(255) NOT NULL, name2 VARCHAR(255) DEFAULT NULL, notes VARCHAR(255) DEFAULT NULL, federal_district_id INT NOT NULL, federal_district_name VARCHAR(255) NOT NULL, region_id INT NOT NULL, region_name VARCHAR(255) NOT NULL, settlement_type_id INT DEFAULT NULL, settlement_type_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE region ADD oktmo INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE lpu_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE oktmo_id_seq CASCADE');
        $this->addSql('DROP TABLE lpu');
        $this->addSql('DROP TABLE oktmo');
        $this->addSql('ALTER TABLE region DROP oktmo');
    }
}
