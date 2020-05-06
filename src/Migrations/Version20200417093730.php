<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200417093730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE polimorphism_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE patient_polimorphism (patient_id INT NOT NULL, polimorphism_id INT NOT NULL, PRIMARY KEY(patient_id, polimorphism_id))');
        $this->addSql('CREATE INDEX IDX_465674AA6B899279 ON patient_polimorphism (patient_id)');
        $this->addSql('CREATE INDEX IDX_465674AA9A41DC5A ON patient_polimorphism (polimorphism_id)');
        $this->addSql('COMMENT ON COLUMN patient_polimorphism.patient_id IS \'Ключ пациента\'');
        $this->addSql('CREATE TABLE polimorphism (id INT NOT NULL, name VARCHAR(255) NOT NULL, title VARCHAR(255) DEFAULT NULL, enabled BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE patient_polimorphism ADD CONSTRAINT FK_465674AA6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient_polimorphism ADD CONSTRAINT FK_465674AA9A41DC5A FOREIGN KEY (polimorphism_id) REFERENCES polimorphism (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('ALTER TABLE patient_polimorphism DROP CONSTRAINT FK_465674AA9A41DC5A');
        $this->addSql('DROP SEQUENCE polimorphism_id_seq CASCADE');
        $this->addSql('DROP TABLE patient_polimorphism');
        $this->addSql('DROP TABLE polimorphism');
    }
}
