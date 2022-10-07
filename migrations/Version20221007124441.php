<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007124441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_configuration DROP FOREIGN KEY FK_C187D5D4B171EB6C');
        $this->addSql('DROP INDEX UNIQ_C187D5D4B171EB6C ON customer_configuration');
        $this->addSql('ALTER TABLE customer_configuration CHANGE customer_id_id customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer_configuration ADD CONSTRAINT FK_C187D5D49395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C187D5D49395C3F3 ON customer_configuration (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_configuration DROP FOREIGN KEY FK_C187D5D49395C3F3');
        $this->addSql('DROP INDEX UNIQ_C187D5D49395C3F3 ON customer_configuration');
        $this->addSql('ALTER TABLE customer_configuration CHANGE customer_id customer_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer_configuration ADD CONSTRAINT FK_C187D5D4B171EB6C FOREIGN KEY (customer_id_id) REFERENCES customer (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C187D5D4B171EB6C ON customer_configuration (customer_id_id)');
    }
}
