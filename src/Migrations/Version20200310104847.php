<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200310104847 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        
        $this->addSql('ALTER TABLE role ALTER enabled DROP DEFAULT, ALTER enabled TYPE BOOLEAN USING enabled::boolean');
        $this->addSql('ALTER TABLE role ALTER enabled DROP DEFAULT, ALTER enabled SET DEFAULT \'true\'');
        $this->addSql('ALTER TABLE country ALTER enabled DROP DEFAULT, ALTER enabled TYPE BOOLEAN USING enabled::boolean');
        $this->addSql('ALTER TABLE country ALTER enabled DROP DEFAULT, ALTER enabled SET DEFAULT \'true\'');
        $this->addSql('ALTER TABLE staff ADD auth_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE staff DROP enabled');
        $this->addSql('COMMENT ON COLUMN staff.auth_user_id IS \'Ключ пользователя\'');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF392E94AF366 FOREIGN KEY (auth_user_id) REFERENCES auth_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_426EF392E94AF366 ON staff (auth_user_id)');
        $this->addSql('ALTER TABLE "position" ALTER enabled DROP DEFAULT, ALTER enabled TYPE BOOLEAN USING enabled::boolean');
        $this->addSql('ALTER TABLE "position" ALTER enabled DROP DEFAULT, ALTER enabled SET DEFAULT \'true\'');
        $this->addSql('DROP INDEX uniq_a3b536fde7927c74');
        $this->addSql('ALTER TABLE auth_user ADD enabled BOOLEAN DEFAULT \'true\' NOT NULL');
        $this->addSql('ALTER TABLE auth_user ALTER email DROP NOT NULL');
        $this->addSql('COMMENT ON COLUMN auth_user.enabled IS \'Ограничение использования\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A3B536FD444F97DD ON auth_user (phone)');
        $this->addSql('ALTER TABLE hospital ALTER enabled DROP DEFAULT, ALTER enabled TYPE BOOLEAN USING enabled::boolean');
        $this->addSql('ALTER TABLE hospital ALTER enabled DROP DEFAULT, ALTER enabled SET DEFAULT \'true\'');
        $this->addSql('ALTER TABLE patient ADD auth_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE patient ADD status_id INT NOT NULL');
        $this->addSql('ALTER TABLE patient DROP status');
        $this->addSql('ALTER TABLE patient ALTER sms_informing DROP DEFAULT, ALTER sms_informing TYPE BOOLEAN USING sms_informing::boolean');
        $this->addSql('ALTER TABLE patient ALTER sms_informing SET DEFAULT \'true\'');
        $this->addSql('ALTER TABLE patient ALTER email_informing DROP DEFAULT, ALTER email_informing TYPE BOOLEAN USING email_informing::boolean');
        $this->addSql('ALTER TABLE patient ALTER email_informing SET DEFAULT \'true\'');
        $this->addSql('COMMENT ON COLUMN patient.auth_user_id IS \'Ключ пользователя\'');
        $this->addSql('COMMENT ON COLUMN patient.status_id IS \'Ключ статуса\'');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBE94AF366 FOREIGN KEY (auth_user_id) REFERENCES auth_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB6BF700BD FOREIGN KEY (status_id) REFERENCES patient_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1ADAD7EBE94AF366 ON patient (auth_user_id)');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB6BF700BD ON patient (status_id)');
        $this->addSql('ALTER TABLE city ALTER enabled DROP DEFAULT, ALTER enabled TYPE BOOLEAN USING enabled::boolean');
        $this->addSql('ALTER TABLE city ALTER enabled SET DEFAULT \'true\'');
        $this->addSql('ALTER TABLE medicine ALTER enabled DROP DEFAULT, ALTER enabled TYPE BOOLEAN USING enabled::boolean');
        $this->addSql('ALTER TABLE medicine ALTER enabled SET DEFAULT \'true\'');
        $this->addSql('ALTER TABLE region ALTER enabled DROP DEFAULT, ALTER enabled TYPE BOOLEAN USING enabled::boolean');
        $this->addSql('ALTER TABLE region ALTER enabled SET DEFAULT \'true\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('ALTER TABLE country ALTER enabled TYPE INT');
        $this->addSql('ALTER TABLE country ALTER enabled SET DEFAULT 1');
        $this->addSql('ALTER TABLE region ALTER enabled TYPE INT');
        $this->addSql('ALTER TABLE region ALTER enabled SET DEFAULT 1');
        $this->addSql('ALTER TABLE city ALTER enabled TYPE INT');
        $this->addSql('ALTER TABLE city ALTER enabled SET DEFAULT 1');
        $this->addSql('ALTER TABLE hospital ALTER enabled TYPE INT');
        $this->addSql('ALTER TABLE hospital ALTER enabled SET DEFAULT 1');
        $this->addSql('ALTER TABLE role ALTER enabled TYPE INT');
        $this->addSql('ALTER TABLE role ALTER enabled SET DEFAULT 1');
        $this->addSql('ALTER TABLE staff DROP CONSTRAINT FK_426EF392E94AF366');
        $this->addSql('DROP INDEX UNIQ_426EF392E94AF366');
        $this->addSql('ALTER TABLE staff ADD enabled INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE staff DROP auth_user_id');
        $this->addSql('COMMENT ON COLUMN staff.enabled IS \'Ограничение использования\'');
        $this->addSql('ALTER TABLE position ALTER enabled TYPE INT');
        $this->addSql('ALTER TABLE position ALTER enabled SET DEFAULT 1');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EBE94AF366');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EB6BF700BD');
        $this->addSql('DROP INDEX UNIQ_1ADAD7EBE94AF366');
        $this->addSql('DROP INDEX IDX_1ADAD7EB6BF700BD');
        $this->addSql('ALTER TABLE patient ADD status INT NOT NULL');
        $this->addSql('ALTER TABLE patient DROP auth_user_id');
        $this->addSql('ALTER TABLE patient DROP status_id');
        $this->addSql('ALTER TABLE patient ALTER sms_informing TYPE INT');
        $this->addSql('ALTER TABLE patient ALTER sms_informing SET DEFAULT 1');
        $this->addSql('ALTER TABLE patient ALTER email_informing TYPE INT');
        $this->addSql('ALTER TABLE patient ALTER email_informing SET DEFAULT 1');
        $this->addSql('COMMENT ON COLUMN patient.status IS \'Статус пациента\'');
        $this->addSql('ALTER TABLE medicine ALTER enabled TYPE INT');
        $this->addSql('ALTER TABLE medicine ALTER enabled SET DEFAULT 1');
        $this->addSql('DROP INDEX UNIQ_A3B536FD444F97DD');
        $this->addSql('ALTER TABLE auth_user DROP enabled');
        $this->addSql('ALTER TABLE auth_user ALTER email SET NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX uniq_a3b536fde7927c74 ON auth_user (email)');
    }
}
