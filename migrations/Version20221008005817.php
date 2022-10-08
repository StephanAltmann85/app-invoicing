<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221008005817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer ADD currency_id INT NOT NULL, ADD locale VARCHAR(2) NOT NULL, ADD rate INT DEFAULT NULL, ADD tax_rate DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E0938248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_81398E0938248176 ON customer (currency_id)');
        $this->addSql('ALTER TABLE customer_configuration DROP FOREIGN KEY FK_C187D5D438248176');
        $this->addSql('ALTER TABLE customer_configuration DROP FOREIGN KEY FK_C187D5D49395C3F3');
        $this->addSql('DROP INDEX UNIQ_C187D5D49395C3F3 ON customer_configuration');
        $this->addSql('DROP INDEX IDX_C187D5D438248176 ON customer_configuration');
        $this->addSql('ALTER TABLE customer_configuration DROP customer_id, DROP currency_id, DROP locale, DROP rate, DROP tax_rate');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E0938248176');
        $this->addSql('DROP INDEX IDX_81398E0938248176 ON customer');
        $this->addSql('ALTER TABLE customer DROP currency_id, DROP locale, DROP rate, DROP tax_rate');
        $this->addSql('ALTER TABLE customer_configuration ADD customer_id INT NOT NULL, ADD currency_id INT NOT NULL, ADD locale VARCHAR(2) NOT NULL, ADD rate INT DEFAULT NULL, ADD tax_rate DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE customer_configuration ADD CONSTRAINT FK_C187D5D438248176 FOREIGN KEY (currency_id) REFERENCES currency (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE customer_configuration ADD CONSTRAINT FK_C187D5D49395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C187D5D49395C3F3 ON customer_configuration (customer_id)');
        $this->addSql('CREATE INDEX IDX_C187D5D438248176 ON customer_configuration (currency_id)');
    }
}
