<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200312090114 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE patient ADD city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD district_id INT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN patient.city_id IS \'Ключ города\'');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBB08FA272 FOREIGN KEY (district_id) REFERENCES district (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB8BAC62AF ON patient (city_id)');
        $this->addSql('CREATE INDEX IDX_1ADAD7EBB08FA272 ON patient (district_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EB8BAC62AF');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EBB08FA272');
        $this->addSql('DROP INDEX IDX_1ADAD7EB8BAC62AF');
        $this->addSql('DROP INDEX IDX_1ADAD7EBB08FA272');
        $this->addSql('ALTER TABLE patient DROP city_id');
        $this->addSql('ALTER TABLE patient DROP district_id');
    }
}
