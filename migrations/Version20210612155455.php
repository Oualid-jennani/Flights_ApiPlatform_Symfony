<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210612155455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vol (id INT AUTO_INCREMENT NOT NULL, start_id INT DEFAULT NULL, finish_id INT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, company VARCHAR(255) NOT NULL, airport VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, time VARCHAR(255) NOT NULL, class VARCHAR(255) NOT NULL, INDEX IDX_95C97EB623DF99B (start_id), INDEX IDX_95C97EB2B4667EB (finish_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EB623DF99B FOREIGN KEY (start_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EB2B4667EB FOREIGN KEY (finish_id) REFERENCES city (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vol');
    }
}
