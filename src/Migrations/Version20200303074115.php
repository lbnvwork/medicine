<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200303074115 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE role ALTER enabled SET DEFAULT 1');
        $this->addSql('COMMENT ON COLUMN role.id IS \'Ключ роли\'');
        $this->addSql('COMMENT ON COLUMN role.name IS \'Название роли\'');
        $this->addSql('COMMENT ON COLUMN role.tech_name IS \'Техническое название\'');
        $this->addSql('COMMENT ON COLUMN role.description IS \'Описание роли\'');
        $this->addSql('COMMENT ON COLUMN role.enabled IS \'Ограничение использования\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('ALTER TABLE role ALTER enabled DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN role.id IS NULL');
        $this->addSql('COMMENT ON COLUMN role.name IS NULL');
        $this->addSql('COMMENT ON COLUMN role.tech_name IS NULL');
        $this->addSql('COMMENT ON COLUMN role.description IS NULL');
        $this->addSql('COMMENT ON COLUMN role.enabled IS NULL');
    }
}
