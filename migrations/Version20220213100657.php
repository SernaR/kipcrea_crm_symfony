<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213100657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('DROP INDEX UNIQ_E7811BF32989F1FD');
        $this->addSql('DROP INDEX UNIQ_E7811BF35E237E06');
        $this->addSql('CREATE TEMPORARY TABLE __temp__advance AS SELECT id, invoice_id, amount, name, sending_date FROM advance');
        $this->addSql('DROP TABLE advance');
        $this->addSql('CREATE TABLE advance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, sending_date DATE DEFAULT NULL, CONSTRAINT FK_E7811BF32989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO advance (id, invoice_id, amount, name, sending_date) SELECT id, invoice_id, amount, name, sending_date FROM __temp__advance');
        $this->addSql('DROP TABLE __temp__advance');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E7811BF32989F1FD ON advance (invoice_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E7811BF35E237E06 ON advance (name)');
        $this->addSql('DROP INDEX IDX_81398E099F2C3FAB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer AS SELECT id, zone_id, company, siret, first_name, last_name, address, address_add_on, city, country, telephone, mail, tva FROM customer');
        $this->addSql('DROP TABLE customer');
        $this->addSql('CREATE TABLE customer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, zone_id INTEGER DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, address_add_on VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) DEFAULT \'France\' NOT NULL, telephone VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) NOT NULL, tva VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_81398E099F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO customer (id, zone_id, company, siret, first_name, last_name, address, address_add_on, city, country, telephone, mail, tva) SELECT id, zone_id, company, siret, first_name, last_name, address, address_add_on, city, country, telephone, mail, tva FROM __temp__customer');
        $this->addSql('DROP TABLE __temp__customer');
        $this->addSql('CREATE INDEX IDX_81398E099F2C3FAB ON customer (zone_id)');
        $this->addSql('DROP INDEX UNIQ_E6C5B242989F1FD');
        $this->addSql('DROP INDEX UNIQ_E6C5B245E237E06');
        $this->addSql('CREATE TEMPORARY TABLE __temp__debit AS SELECT id, invoice_id, name, sending_date FROM debit');
        $this->addSql('DROP TABLE debit');
        $this->addSql('CREATE TABLE debit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, sending_date DATE DEFAULT NULL, CONSTRAINT FK_E6C5B242989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO debit (id, invoice_id, name, sending_date) SELECT id, invoice_id, name, sending_date FROM __temp__debit');
        $this->addSql('DROP TABLE __temp__debit');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6C5B242989F1FD ON debit (invoice_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6C5B245E237E06 ON debit (name)');
        $this->addSql('DROP INDEX UNIQ_90651744B4EA4E60');
        $this->addSql('DROP INDEX UNIQ_906517445E237E06');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice AS SELECT id, quotation_id, name, sending_date, delivery_date, is_settle FROM invoice');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('CREATE TABLE invoice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, quotation_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, sending_date DATE DEFAULT NULL, delivery_date DATE DEFAULT NULL, is_settle BOOLEAN DEFAULT 0 NOT NULL, CONSTRAINT FK_90651744B4EA4E60 FOREIGN KEY (quotation_id) REFERENCES quotation (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO invoice (id, quotation_id, name, sending_date, delivery_date, is_settle) SELECT id, quotation_id, name, sending_date, delivery_date, is_settle FROM __temp__invoice');
        $this->addSql('DROP TABLE __temp__invoice');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_90651744B4EA4E60 ON invoice (quotation_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_906517445E237E06 ON invoice (name)');
        $this->addSql('DROP INDEX IDX_1344AC012989F1FD');
        $this->addSql('DROP INDEX IDX_1344AC01ED5CA9E6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice_service AS SELECT id, service_id, invoice_id, quantity FROM invoice_service');
        $this->addSql('DROP TABLE invoice_service');
        $this->addSql('CREATE TABLE invoice_service (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, service_id INTEGER DEFAULT NULL, invoice_id INTEGER DEFAULT NULL, quantity INTEGER DEFAULT 1 NOT NULL, CONSTRAINT FK_1344AC01ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1344AC012989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO invoice_service (id, service_id, invoice_id, quantity) SELECT id, service_id, invoice_id, quantity FROM __temp__invoice_service');
        $this->addSql('DROP TABLE __temp__invoice_service');
        $this->addSql('CREATE INDEX IDX_1344AC012989F1FD ON invoice_service (invoice_id)');
        $this->addSql('CREATE INDEX IDX_1344AC01ED5CA9E6 ON invoice_service (service_id)');
        $this->addSql('DROP INDEX IDX_474A8DB99395C3F3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__quotation AS SELECT id, customer_id, sending_date, cancel_date, validation_date, discount FROM quotation');
        $this->addSql('DROP TABLE quotation');
        $this->addSql('CREATE TABLE quotation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, customer_id INTEGER DEFAULT NULL, sending_date DATE DEFAULT NULL, cancel_date DATE DEFAULT NULL, validation_date DATE DEFAULT NULL, discount INTEGER DEFAULT NULL, CONSTRAINT FK_474A8DB99395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO quotation (id, customer_id, sending_date, cancel_date, validation_date, discount) SELECT id, customer_id, sending_date, cancel_date, validation_date, discount FROM __temp__quotation');
        $this->addSql('DROP TABLE __temp__quotation');
        $this->addSql('CREATE INDEX IDX_474A8DB99395C3F3 ON quotation (customer_id)');
        $this->addSql('DROP INDEX IDX_F1BD9042B4EA4E60');
        $this->addSql('DROP INDEX IDX_F1BD9042ED5CA9E6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__quotation_service AS SELECT id, service_id, quotation_id, quantity FROM quotation_service');
        $this->addSql('DROP TABLE quotation_service');
        $this->addSql('CREATE TABLE quotation_service (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, service_id INTEGER DEFAULT NULL, quotation_id INTEGER DEFAULT NULL, quantity INTEGER DEFAULT 1 NOT NULL, CONSTRAINT FK_F1BD9042ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F1BD9042B4EA4E60 FOREIGN KEY (quotation_id) REFERENCES quotation (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO quotation_service (id, service_id, quotation_id, quantity) SELECT id, service_id, quotation_id, quantity FROM __temp__quotation_service');
        $this->addSql('DROP TABLE __temp__quotation_service');
        $this->addSql('CREATE INDEX IDX_F1BD9042B4EA4E60 ON quotation_service (quotation_id)');
        $this->addSql('CREATE INDEX IDX_F1BD9042ED5CA9E6 ON quotation_service (service_id)');
        $this->addSql('DROP INDEX IDX_E19D9AD2C54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__service AS SELECT id, type_id, name, label, description, amount, is_done FROM service');
        $this->addSql('DROP TABLE service');
        $this->addSql('CREATE TABLE service (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, description CLOB NOT NULL, amount DOUBLE PRECISION NOT NULL, is_done BOOLEAN DEFAULT 0 NOT NULL, CONSTRAINT FK_E19D9AD2C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO service (id, type_id, name, label, description, amount, is_done) SELECT id, type_id, name, label, description, amount, is_done FROM __temp__service');
        $this->addSql('DROP TABLE __temp__service');
        $this->addSql('CREATE INDEX IDX_E19D9AD2C54C8C93 ON service (type_id)');
        $this->addSql('DROP INDEX UNIQ_A87C621C2989F1FD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tracking AS SELECT id, invoice_id, is_licence, is_copyright, is_annual_maintenance, is_monthly_maintenance, is_settle FROM tracking');
        $this->addSql('DROP TABLE tracking');
        $this->addSql('CREATE TABLE tracking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER DEFAULT NULL, is_licence BOOLEAN DEFAULT 0 NOT NULL, is_copyright BOOLEAN DEFAULT 0 NOT NULL, is_annual_maintenance BOOLEAN DEFAULT 0 NOT NULL, is_monthly_maintenance BOOLEAN DEFAULT 0 NOT NULL, is_settle BOOLEAN DEFAULT 0 NOT NULL, CONSTRAINT FK_A87C621C2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tracking (id, invoice_id, is_licence, is_copyright, is_annual_maintenance, is_monthly_maintenance, is_settle) SELECT id, invoice_id, is_licence, is_copyright, is_annual_maintenance, is_monthly_maintenance, is_settle FROM __temp__tracking');
        $this->addSql('DROP TABLE __temp__tracking');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A87C621C2989F1FD ON tracking (invoice_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX UNIQ_E7811BF35E237E06');
        $this->addSql('DROP INDEX UNIQ_E7811BF32989F1FD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__advance AS SELECT id, invoice_id, amount, name, sending_date FROM advance');
        $this->addSql('DROP TABLE advance');
        $this->addSql('CREATE TABLE advance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, sending_date DATE DEFAULT NULL)');
        $this->addSql('INSERT INTO advance (id, invoice_id, amount, name, sending_date) SELECT id, invoice_id, amount, name, sending_date FROM __temp__advance');
        $this->addSql('DROP TABLE __temp__advance');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E7811BF35E237E06 ON advance (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E7811BF32989F1FD ON advance (invoice_id)');
        $this->addSql('DROP INDEX IDX_81398E099F2C3FAB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer AS SELECT id, zone_id, company, siret, first_name, last_name, address, address_add_on, city, country, telephone, mail, tva FROM customer');
        $this->addSql('DROP TABLE customer');
        $this->addSql('CREATE TABLE customer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, zone_id INTEGER DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, address_add_on VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) DEFAULT \'France\' NOT NULL, telephone VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) NOT NULL, tva VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO customer (id, zone_id, company, siret, first_name, last_name, address, address_add_on, city, country, telephone, mail, tva) SELECT id, zone_id, company, siret, first_name, last_name, address, address_add_on, city, country, telephone, mail, tva FROM __temp__customer');
        $this->addSql('DROP TABLE __temp__customer');
        $this->addSql('CREATE INDEX IDX_81398E099F2C3FAB ON customer (zone_id)');
        $this->addSql('DROP INDEX UNIQ_E6C5B245E237E06');
        $this->addSql('DROP INDEX UNIQ_E6C5B242989F1FD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__debit AS SELECT id, invoice_id, name, sending_date FROM debit');
        $this->addSql('DROP TABLE debit');
        $this->addSql('CREATE TABLE debit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, sending_date DATE DEFAULT NULL)');
        $this->addSql('INSERT INTO debit (id, invoice_id, name, sending_date) SELECT id, invoice_id, name, sending_date FROM __temp__debit');
        $this->addSql('DROP TABLE __temp__debit');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6C5B245E237E06 ON debit (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6C5B242989F1FD ON debit (invoice_id)');
        $this->addSql('DROP INDEX UNIQ_906517445E237E06');
        $this->addSql('DROP INDEX UNIQ_90651744B4EA4E60');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice AS SELECT id, quotation_id, name, sending_date, delivery_date, is_settle FROM invoice');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('CREATE TABLE invoice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, quotation_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, sending_date DATE DEFAULT NULL, delivery_date DATE DEFAULT NULL, is_settle BOOLEAN DEFAULT 0 NOT NULL)');
        $this->addSql('INSERT INTO invoice (id, quotation_id, name, sending_date, delivery_date, is_settle) SELECT id, quotation_id, name, sending_date, delivery_date, is_settle FROM __temp__invoice');
        $this->addSql('DROP TABLE __temp__invoice');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_906517445E237E06 ON invoice (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_90651744B4EA4E60 ON invoice (quotation_id)');
        $this->addSql('DROP INDEX IDX_1344AC01ED5CA9E6');
        $this->addSql('DROP INDEX IDX_1344AC012989F1FD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice_service AS SELECT id, service_id, invoice_id, quantity FROM invoice_service');
        $this->addSql('DROP TABLE invoice_service');
        $this->addSql('CREATE TABLE invoice_service (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, service_id INTEGER DEFAULT NULL, invoice_id INTEGER DEFAULT NULL, quantity INTEGER DEFAULT 1 NOT NULL)');
        $this->addSql('INSERT INTO invoice_service (id, service_id, invoice_id, quantity) SELECT id, service_id, invoice_id, quantity FROM __temp__invoice_service');
        $this->addSql('DROP TABLE __temp__invoice_service');
        $this->addSql('CREATE INDEX IDX_1344AC01ED5CA9E6 ON invoice_service (service_id)');
        $this->addSql('CREATE INDEX IDX_1344AC012989F1FD ON invoice_service (invoice_id)');
        $this->addSql('DROP INDEX IDX_474A8DB99395C3F3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__quotation AS SELECT id, customer_id, sending_date, cancel_date, validation_date, discount FROM quotation');
        $this->addSql('DROP TABLE quotation');
        $this->addSql('CREATE TABLE quotation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, customer_id INTEGER DEFAULT NULL, sending_date DATE DEFAULT NULL, cancel_date DATE DEFAULT NULL, validation_date DATE DEFAULT NULL, discount INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO quotation (id, customer_id, sending_date, cancel_date, validation_date, discount) SELECT id, customer_id, sending_date, cancel_date, validation_date, discount FROM __temp__quotation');
        $this->addSql('DROP TABLE __temp__quotation');
        $this->addSql('CREATE INDEX IDX_474A8DB99395C3F3 ON quotation (customer_id)');
        $this->addSql('DROP INDEX IDX_F1BD9042ED5CA9E6');
        $this->addSql('DROP INDEX IDX_F1BD9042B4EA4E60');
        $this->addSql('CREATE TEMPORARY TABLE __temp__quotation_service AS SELECT id, service_id, quotation_id, quantity FROM quotation_service');
        $this->addSql('DROP TABLE quotation_service');
        $this->addSql('CREATE TABLE quotation_service (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, service_id INTEGER DEFAULT NULL, quotation_id INTEGER DEFAULT NULL, quantity INTEGER DEFAULT 1 NOT NULL)');
        $this->addSql('INSERT INTO quotation_service (id, service_id, quotation_id, quantity) SELECT id, service_id, quotation_id, quantity FROM __temp__quotation_service');
        $this->addSql('DROP TABLE __temp__quotation_service');
        $this->addSql('CREATE INDEX IDX_F1BD9042ED5CA9E6 ON quotation_service (service_id)');
        $this->addSql('CREATE INDEX IDX_F1BD9042B4EA4E60 ON quotation_service (quotation_id)');
        $this->addSql('DROP INDEX IDX_E19D9AD2C54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__service AS SELECT id, type_id, name, label, description, amount, is_done FROM service');
        $this->addSql('DROP TABLE service');
        $this->addSql('CREATE TABLE service (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, description CLOB NOT NULL, amount DOUBLE PRECISION NOT NULL, is_done BOOLEAN DEFAULT 0 NOT NULL)');
        $this->addSql('INSERT INTO service (id, type_id, name, label, description, amount, is_done) SELECT id, type_id, name, label, description, amount, is_done FROM __temp__service');
        $this->addSql('DROP TABLE __temp__service');
        $this->addSql('CREATE INDEX IDX_E19D9AD2C54C8C93 ON service (type_id)');
        $this->addSql('DROP INDEX UNIQ_A87C621C2989F1FD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tracking AS SELECT id, invoice_id, is_licence, is_copyright, is_annual_maintenance, is_monthly_maintenance, is_settle FROM tracking');
        $this->addSql('DROP TABLE tracking');
        $this->addSql('CREATE TABLE tracking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER DEFAULT NULL, is_licence BOOLEAN DEFAULT 0 NOT NULL, is_copyright BOOLEAN DEFAULT 0 NOT NULL, is_annual_maintenance BOOLEAN DEFAULT 0 NOT NULL, is_monthly_maintenance BOOLEAN DEFAULT 0 NOT NULL, is_settle BOOLEAN DEFAULT 0 NOT NULL)');
        $this->addSql('INSERT INTO tracking (id, invoice_id, is_licence, is_copyright, is_annual_maintenance, is_monthly_maintenance, is_settle) SELECT id, invoice_id, is_licence, is_copyright, is_annual_maintenance, is_monthly_maintenance, is_settle FROM __temp__tracking');
        $this->addSql('DROP TABLE __temp__tracking');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A87C621C2989F1FD ON tracking (invoice_id)');
    }
}
