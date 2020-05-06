<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504135856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE trimester_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE trimester (id INT NOT NULL, name VARCHAR(50) NOT NULL, title VARCHAR(50) NOT NULL, number INT NOT NULL, enabled BOOLEAN DEFAULT \'true\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN trimester.id IS \'Ключ триместра\'');
        $this->addSql('COMMENT ON COLUMN trimester.name IS \'Название триместра\'');
        $this->addSql('COMMENT ON COLUMN trimester.title IS \'Заголовок триместра\'');
        $this->addSql('COMMENT ON COLUMN trimester.number IS \'Номер триместра\'');
        $this->addSql('COMMENT ON COLUMN trimester.enabled IS \'Ограничение использования\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE trimester_id_seq CASCADE');
        $this->addSql('DROP TABLE trimester');
    }
}
