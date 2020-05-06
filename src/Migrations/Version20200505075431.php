<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200505075431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE analysis_rate_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE analysis_rate (id INT NOT NULL, analysis_id INT NOT NULL, trimester_id INT NOT NULL, measure_id INT NOT NULL, rate_min DOUBLE PRECISION NOT NULL, rate_max DOUBLE PRECISION NOT NULL, enabled BOOLEAN DEFAULT \'true\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EE5F7AD27941003F ON analysis_rate (analysis_id)');
        $this->addSql('CREATE INDEX IDX_EE5F7AD2A6D57929 ON analysis_rate (trimester_id)');
        $this->addSql('CREATE INDEX IDX_EE5F7AD25DA37D00 ON analysis_rate (measure_id)');
        $this->addSql('COMMENT ON COLUMN analysis_rate.id IS \'Ключ нормальных значений\'');
        $this->addSql('COMMENT ON COLUMN analysis_rate.analysis_id IS \'Ключ анализа\'');
        $this->addSql('COMMENT ON COLUMN analysis_rate.trimester_id IS \'Ключ триместра\'');
        $this->addSql('COMMENT ON COLUMN analysis_rate.measure_id IS \'Ключ единицы измерения\'');
        $this->addSql('COMMENT ON COLUMN analysis_rate.rate_min IS \'Минимальное нормальное значение\'');
        $this->addSql('COMMENT ON COLUMN analysis_rate.rate_max IS \'Максимальное нормальное значение\'');
        $this->addSql('COMMENT ON COLUMN analysis_rate.enabled IS \'Ограничение использования\'');
        $this->addSql('ALTER TABLE analysis_rate ADD CONSTRAINT FK_EE5F7AD27941003F FOREIGN KEY (analysis_id) REFERENCES analysis (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE analysis_rate ADD CONSTRAINT FK_EE5F7AD2A6D57929 FOREIGN KEY (trimester_id) REFERENCES trimester (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE analysis_rate ADD CONSTRAINT FK_EE5F7AD25DA37D00 FOREIGN KEY (measure_id) REFERENCES measure (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE analysis_rate_id_seq CASCADE');
        $this->addSql('DROP TABLE analysis_rate');
    }
}
