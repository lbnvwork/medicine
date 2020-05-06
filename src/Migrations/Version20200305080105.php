<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200305080105 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('COMMENT ON COLUMN auth_user.id IS \'Ключ пользователя\'');
        $this->addSql('COMMENT ON COLUMN auth_user.email IS \'Email пользователя\'');
        $this->addSql('COMMENT ON COLUMN auth_user.roles IS \'Роли пользователя\'');
        $this->addSql('COMMENT ON COLUMN auth_user.password IS \'Пароль пользователя\'');
        $this->addSql('COMMENT ON COLUMN auth_user.phone IS \'Телефон пользователя\'');
        $this->addSql('COMMENT ON COLUMN auth_user.first_name IS \'Имя пользователя\'');
        $this->addSql('COMMENT ON COLUMN auth_user.last_name IS \'Фамилия пользователя\'');
        $this->addSql('COMMENT ON COLUMN auth_user.patronymic_name IS \'Отчество пользователя\'');
        $this->addSql('COMMENT ON COLUMN auth_user.description IS \'Описание/комментарий\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('COMMENT ON COLUMN auth_user.id IS NULL');
        $this->addSql('COMMENT ON COLUMN auth_user.email IS NULL');
        $this->addSql('COMMENT ON COLUMN auth_user.roles IS NULL');
        $this->addSql('COMMENT ON COLUMN auth_user.password IS NULL');
        $this->addSql('COMMENT ON COLUMN auth_user.phone IS NULL');
        $this->addSql('COMMENT ON COLUMN auth_user.first_name IS NULL');
        $this->addSql('COMMENT ON COLUMN auth_user.last_name IS NULL');
        $this->addSql('COMMENT ON COLUMN auth_user.patronymic_name IS NULL');
        $this->addSql('COMMENT ON COLUMN auth_user.description IS NULL');
    }
}
