<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504110708 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE measure_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE measure (id INT NOT NULL, name_ru VARCHAR(10) NOT NULL, name_en VARCHAR(10) DEFAULT NULL, title VARCHAR(100) DEFAULT NULL, enabled BOOLEAN DEFAULT \'true\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN measure.id IS \'Ключ единицы измерения\'');
        $this->addSql('COMMENT ON COLUMN measure.name_ru IS \'Русское название единицы измерения\'');
        $this->addSql('COMMENT ON COLUMN measure.name_en IS \'Английское название единицы измерения\'');
        $this->addSql('COMMENT ON COLUMN measure.title IS \'Описание единицы измерения\'');
        $this->addSql('COMMENT ON COLUMN measure.enabled IS \'Ограничение использования\'');
        $this->addSql('ALTER TABLE analysis ALTER enabled SET DEFAULT \'false\'');
        $this->addSql('COMMENT ON COLUMN analysis.id IS \'Ключ анализа\'');
        $this->addSql('COMMENT ON COLUMN analysis.analysis_group_id IS \'Ключ группы анализов\'');
        $this->addSql('COMMENT ON COLUMN analysis.name IS \'Название анализа\'');
        $this->addSql('COMMENT ON COLUMN analysis.description IS \'Описание анализа\'');
        $this->addSql('COMMENT ON COLUMN analysis.enabled IS \'Ограничение использования\'');
        $this->addSql('ALTER TABLE analysis_group ALTER enabled SET DEFAULT \'true\'');
        $this->addSql('COMMENT ON COLUMN analysis_group.id IS \'Ключ группы анализов\'');
        $this->addSql('COMMENT ON COLUMN analysis_group.name IS \'Название группы анализов (аббревиатура)\'');
        $this->addSql('COMMENT ON COLUMN analysis_group.full_name IS \'Полное название группы анализов (расшифровка аббревиатуры)\'');
        $this->addSql('COMMENT ON COLUMN analysis_group.enabled IS \'Ограничение использования\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE measure_id_seq CASCADE');
        $this->addSql('DROP TABLE measure');
        $this->addSql('ALTER TABLE analysis_group ALTER enabled DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN analysis_group.id IS NULL');
        $this->addSql('COMMENT ON COLUMN analysis_group.name IS NULL');
        $this->addSql('COMMENT ON COLUMN analysis_group.full_name IS NULL');
        $this->addSql('COMMENT ON COLUMN analysis_group.enabled IS NULL');
        $this->addSql('ALTER TABLE analysis ALTER enabled DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN analysis.id IS NULL');
        $this->addSql('COMMENT ON COLUMN analysis.analysis_group_id IS NULL');
        $this->addSql('COMMENT ON COLUMN analysis.name IS NULL');
        $this->addSql('COMMENT ON COLUMN analysis.description IS NULL');
        $this->addSql('COMMENT ON COLUMN analysis.enabled IS NULL');
    }
}
