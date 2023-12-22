<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231222001523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE caserne (id INT AUTO_INCREMENT NOT NULL, id_companie_id INT DEFAULT NULL, nom VARCHAR(70) NOT NULL, adresse VARCHAR(150) NOT NULL, INDEX IDX_C7C3A71785D603E8 (id_companie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE caserne ADD CONSTRAINT FK_C7C3A71785D603E8 FOREIGN KEY (id_companie_id) REFERENCES companie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caserne DROP FOREIGN KEY FK_C7C3A71785D603E8');
        $this->addSql('DROP TABLE caserne');
    }
}
