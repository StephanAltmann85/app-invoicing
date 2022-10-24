<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221024090658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice ADD document_file VARCHAR(255) DEFAULT NULL, CHANGE number number VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_906517442B2BBA83 ON invoice (document_file)');
        $this->addSql('ALTER TABLE invoice_position CHANGE quantity quantity DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_906517442B2BBA83 ON invoice');
        $this->addSql('ALTER TABLE invoice DROP document_file, CHANGE number number VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE invoice_position CHANGE quantity quantity INT NOT NULL');
    }
}
