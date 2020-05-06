<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200302150237 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE region ALTER enabled SET DEFAULT 1');
        $this->addSql('COMMENT ON COLUMN region.id IS \'Ключ региона\'');
        $this->addSql('COMMENT ON COLUMN region.name IS \'Название региона\'');
        $this->addSql('COMMENT ON COLUMN region.region_number IS \'Номер региона\'');
        $this->addSql('COMMENT ON COLUMN region.enabled IS \'Ограничение использования\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('ALTER TABLE region ALTER enabled DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN region.id IS NULL');
        $this->addSql('COMMENT ON COLUMN region.name IS NULL');
        $this->addSql('COMMENT ON COLUMN region.region_number IS NULL');
        $this->addSql('COMMENT ON COLUMN region.enabled IS NULL');
    }
}
