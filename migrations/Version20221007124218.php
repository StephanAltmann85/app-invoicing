<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007124218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, iso3 VARCHAR(3) NOT NULL, symbol VARCHAR(10) NOT NULL, symbol_alignment INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_configuration (id INT AUTO_INCREMENT NOT NULL, customer_id_id INT NOT NULL, currency_id INT NOT NULL, locale VARCHAR(2) NOT NULL, rate INT DEFAULT NULL, tax_rate DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_C187D5D4B171EB6C (customer_id_id), INDEX IDX_C187D5D438248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, number VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_906517449395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_positions (id INT AUTO_INCREMENT NOT NULL, invoice_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, quantity INT NOT NULL, rate INT DEFAULT NULL, INDEX IDX_B33014E02989F1FD (invoice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer_configuration ADD CONSTRAINT FK_C187D5D4B171EB6C FOREIGN KEY (customer_id_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE customer_configuration ADD CONSTRAINT FK_C187D5D438248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517449395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE invoice_positions ADD CONSTRAINT FK_B33014E02989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_configuration DROP FOREIGN KEY FK_C187D5D4B171EB6C');
        $this->addSql('ALTER TABLE customer_configuration DROP FOREIGN KEY FK_C187D5D438248176');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517449395C3F3');
        $this->addSql('ALTER TABLE invoice_positions DROP FOREIGN KEY FK_B33014E02989F1FD');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE customer_configuration');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoice_positions');
    }
}
