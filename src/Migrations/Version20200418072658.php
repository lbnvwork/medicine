<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200418072658 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE patient DROP CONSTRAINT fk_1adad7eb708a0e0');
        $this->addSql('DROP SEQUENCE gender_id_seq CASCADE');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP INDEX idx_1adad7eb708a0e0');
        $this->addSql('ALTER TABLE patient DROP gender_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('CREATE SEQUENCE gender_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE gender (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN gender.id IS \'Ключ пола\'');
        $this->addSql('COMMENT ON COLUMN gender.name IS \'Имя пола\'');
        $this->addSql('ALTER TABLE patient ADD gender_id INT NOT NULL');
        $this->addSql('COMMENT ON COLUMN patient.gender_id IS \'Ключ пола\'');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT fk_1adad7eb708a0e0 FOREIGN KEY (gender_id) REFERENCES gender (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1adad7eb708a0e0 ON patient (gender_id)');
    }
}
