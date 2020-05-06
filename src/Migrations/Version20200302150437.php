<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200302150437 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE region DROP CONSTRAINT fk_f62f176d8a48bbd');
        $this->addSql('DROP INDEX idx_f62f176d8a48bbd');
        $this->addSql('ALTER TABLE region RENAME COLUMN country_id_id TO country_id');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F176F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F62F176F92F3E70 ON region (country_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('ALTER TABLE region DROP CONSTRAINT FK_F62F176F92F3E70');
        $this->addSql('DROP INDEX IDX_F62F176F92F3E70');
        $this->addSql('ALTER TABLE region RENAME COLUMN country_id TO country_id_id');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT fk_f62f176d8a48bbd FOREIGN KEY (country_id_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_f62f176d8a48bbd ON region (country_id_id)');
    }
}
