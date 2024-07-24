<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240724065440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE clients_incremental_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE loans_incremental_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE clients (incremental_id INT NOT NULL, id UUID NOT NULL, full_name_first_name VARCHAR(255) NOT NULL, full_name_last_name VARCHAR(255) NOT NULL, age_age INT NOT NULL, address_city VARCHAR(255) NOT NULL, address_state VARCHAR(50) NOT NULL, address_zip_code VARCHAR(255) NOT NULL, ssn_value VARCHAR(255) NOT NULL, contacts_email VARCHAR(255) NOT NULL, contacts_phone VARCHAR(255) NOT NULL, financial_details_credit_score INT NOT NULL, financial_details_income DECIMAL(10,2) NOT NULL, PRIMARY KEY(incremental_id))');
        $this->addSql('COMMENT ON COLUMN clients.id IS \'(DC2Type:client_id)\'');
        $this->addSql('COMMENT ON COLUMN clients.address_state IS \'(DC2Type:state_type)\'');
        $this->addSql('COMMENT ON COLUMN clients.financial_details_income IS \'(DC2Type:custom_decimal)\'');
        $this->addSql('CREATE TABLE loans (incremental_id INT NOT NULL, id UUID NOT NULL, client_id VARCHAR(255) NOT NULL, type VARCHAR(50) NOT NULL, loan_term INT NOT NULL, interest_rate DECIMAL(10,2) NOT NULL, amount DECIMAL(10,2) NOT NULL, total_amount DECIMAL(10,2) NOT NULL, PRIMARY KEY(incremental_id))');
        $this->addSql('COMMENT ON COLUMN loans.id IS \'(DC2Type:loan_id)\'');
        $this->addSql('COMMENT ON COLUMN loans.type IS \'(DC2Type:loan_type)\'');
        $this->addSql('COMMENT ON COLUMN loans.interest_rate IS \'(DC2Type:custom_decimal)\'');
        $this->addSql('COMMENT ON COLUMN loans.amount IS \'(DC2Type:custom_decimal)\'');
        $this->addSql('COMMENT ON COLUMN loans.total_amount IS \'(DC2Type:custom_decimal)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE clients_incremental_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE loans_incremental_id_seq CASCADE');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE loans');
    }
}
