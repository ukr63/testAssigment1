<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250907141804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lead (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, country_code VARCHAR(2) NOT NULL, box_id INTEGER NOT NULL, offer_id INTEGER NOT NULL, landing_url CLOB NOT NULL, ip VARCHAR(40) NOT NULL, password VARCHAR(255) DEFAULT NULL, language VARCHAR(20) DEFAULT NULL, click_id VARCHAR(500) DEFAULT NULL, quiz_answers VARCHAR(500) DEFAULT NULL, custom1 VARCHAR(500) DEFAULT NULL, custom2 VARCHAR(500) DEFAULT NULL, custom3 VARCHAR(500) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL)');
        $this->addSql('CREATE TABLE lead_status (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lead_id INTEGER NOT NULL, status VARCHAR(255) NOT NULL, ftd BOOLEAN NOT NULL, CONSTRAINT FK_6611C6055458D FOREIGN KEY (lead_id) REFERENCES lead (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6611C6055458D ON lead_status (lead_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lead');
        $this->addSql('DROP TABLE lead_status');
    }
}
