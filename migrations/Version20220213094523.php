<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213094523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE advance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, sending_date DATE DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E7811BF35E237E06 ON advance (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E7811BF32989F1FD ON advance (invoice_id)');
        $this->addSql('CREATE TABLE customer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, zone_id INTEGER DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, address_add_on VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) DEFAULT \'France\' NOT NULL, telephone VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) NOT NULL, tva VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_81398E099F2C3FAB ON customer (zone_id)');
        $this->addSql('CREATE TABLE debit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, sending_date DATE DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6C5B245E237E06 ON debit (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6C5B242989F1FD ON debit (invoice_id)');
        $this->addSql('CREATE TABLE invoice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, quotation_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, sending_date DATE DEFAULT NULL, delivery_date DATE DEFAULT NULL, is_settle BOOLEAN DEFAULT 0 NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_906517445E237E06 ON invoice (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_90651744B4EA4E60 ON invoice (quotation_id)');
        $this->addSql('CREATE TABLE invoice_service (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, service_id INTEGER DEFAULT NULL, invoice_id INTEGER DEFAULT NULL, quantity INTEGER DEFAULT 1 NOT NULL)');
        $this->addSql('CREATE INDEX IDX_1344AC01ED5CA9E6 ON invoice_service (service_id)');
        $this->addSql('CREATE INDEX IDX_1344AC012989F1FD ON invoice_service (invoice_id)');
        $this->addSql('CREATE TABLE operation_counter (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, count INTEGER DEFAULT 1 NOT NULL)');
        $this->addSql('CREATE TABLE quotation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, customer_id INTEGER DEFAULT NULL, sending_date DATE DEFAULT NULL, cancel_date DATE DEFAULT NULL, validation_date DATE DEFAULT NULL, discount INTEGER DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_474A8DB99395C3F3 ON quotation (customer_id)');
        $this->addSql('CREATE TABLE quotation_service (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, service_id INTEGER DEFAULT NULL, quotation_id INTEGER DEFAULT NULL, quantity INTEGER DEFAULT 1 NOT NULL)');
        $this->addSql('CREATE INDEX IDX_F1BD9042ED5CA9E6 ON quotation_service (service_id)');
        $this->addSql('CREATE INDEX IDX_F1BD9042B4EA4E60 ON quotation_service (quotation_id)');
        $this->addSql('CREATE TABLE service (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, description CLOB NOT NULL, amount DOUBLE PRECISION NOT NULL, is_done BOOLEAN DEFAULT 0 NOT NULL)');
        $this->addSql('CREATE INDEX IDX_E19D9AD2C54C8C93 ON service (type_id)');
        $this->addSql('CREATE TABLE tracking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER DEFAULT NULL, is_licence BOOLEAN DEFAULT 0 NOT NULL, is_copyright BOOLEAN DEFAULT 0 NOT NULL, is_annual_maintenance BOOLEAN DEFAULT 0 NOT NULL, is_monthly_maintenance BOOLEAN DEFAULT 0 NOT NULL, is_settle BOOLEAN DEFAULT 0 NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A87C621C2989F1FD ON tracking (invoice_id)');
        $this->addSql('CREATE TABLE type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(3) NOT NULL, label VARCHAR(255) NOT NULL, is_discount BOOLEAN DEFAULT 0 NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8CDE57295E237E06 ON type (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8CDE5729EA750E8 ON type (label)');
        $this->addSql('CREATE TABLE zone (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A0EBC0075E237E06 ON zone (name)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE advance');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE debit');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoice_service');
        $this->addSql('DROP TABLE operation_counter');
        $this->addSql('DROP TABLE quotation');
        $this->addSql('DROP TABLE quotation_service');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE tracking');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE zone');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
