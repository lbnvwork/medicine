<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200428145048 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE risk_factor_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE prevention_way_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE risk_factor_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE risk_factor (id INT NOT NULL, polimorphism_id INT DEFAULT NULL, risk_factor_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, scores INT NOT NULL, enabled BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2DF3E2649A41DC5A ON risk_factor (polimorphism_id)');
        $this->addSql('CREATE INDEX IDX_2DF3E264DBCDF493 ON risk_factor (risk_factor_type_id)');
        $this->addSql('CREATE TABLE prevention_way (id INT NOT NULL, name VARCHAR(255) NOT NULL, min_total_points INT NOT NULL, enabled BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE risk_factor_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE risk_factor ADD CONSTRAINT FK_2DF3E2649A41DC5A FOREIGN KEY (polimorphism_id) REFERENCES polimorphism (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE risk_factor ADD CONSTRAINT FK_2DF3E264DBCDF493 FOREIGN KEY (risk_factor_type_id) REFERENCES risk_factor_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('ALTER TABLE risk_factor DROP CONSTRAINT FK_2DF3E264DBCDF493');
        $this->addSql('DROP SEQUENCE risk_factor_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE prevention_way_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE risk_factor_type_id_seq CASCADE');
        $this->addSql('DROP TABLE risk_factor');
        $this->addSql('DROP TABLE prevention_way');
        $this->addSql('DROP TABLE risk_factor_type');
    }
}
