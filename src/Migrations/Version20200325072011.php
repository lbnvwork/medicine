<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200325072011 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE hospital ADD lpu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hospital ADD CONSTRAINT FK_4282C85BF2C7C2C1 FOREIGN KEY (lpu_id) REFERENCES lpu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4282C85BF2C7C2C1 ON hospital (lpu_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE hospital DROP CONSTRAINT FK_4282C85BF2C7C2C1');
        $this->addSql('DROP INDEX UNIQ_4282C85BF2C7C2C1');
        $this->addSql('ALTER TABLE hospital DROP lpu_id');
    }
}
