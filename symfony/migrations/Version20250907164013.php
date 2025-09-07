<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250907164013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__lead_status AS SELECT id, lead_id, status, ftd FROM lead_status');
        $this->addSql('DROP TABLE lead_status');
        $this->addSql('CREATE TABLE lead_status (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lead_id INTEGER NOT NULL, status VARCHAR(255) NOT NULL, ftd BOOLEAN NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CONSTRAINT FK_6611C6055458D FOREIGN KEY (lead_id) REFERENCES lead (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO lead_status (id, lead_id, status, ftd) SELECT id, lead_id, status, ftd FROM __temp__lead_status');
        $this->addSql('DROP TABLE __temp__lead_status');
        $this->addSql('CREATE INDEX IDX_6611C6055458D ON lead_status (lead_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__lead_status AS SELECT id, lead_id, status, ftd FROM lead_status');
        $this->addSql('DROP TABLE lead_status');
        $this->addSql('CREATE TABLE lead_status (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lead_id INTEGER NOT NULL, status VARCHAR(255) NOT NULL, ftd BOOLEAN NOT NULL, CONSTRAINT FK_6611C6055458D FOREIGN KEY (lead_id) REFERENCES lead (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO lead_status (id, lead_id, status, ftd) SELECT id, lead_id, status, ftd FROM __temp__lead_status');
        $this->addSql('DROP TABLE __temp__lead_status');
        $this->addSql('CREATE INDEX IDX_6611C6055458D ON lead_status (lead_id)');
    }
}
