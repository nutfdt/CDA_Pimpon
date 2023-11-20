<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231119130115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, id_caserne_id INT DEFAULT NULL, id_equipement_id INT DEFAULT NULL, quantite INT NOT NULL, limite_stock INT NOT NULL, INDEX IDX_4B365660398949F1 (id_caserne_id), INDEX IDX_4B3656603E47DE39 (id_equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660398949F1 FOREIGN KEY (id_caserne_id) REFERENCES caserne (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656603E47DE39 FOREIGN KEY (id_equipement_id) REFERENCES equipement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660398949F1');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656603E47DE39');
        $this->addSql('DROP TABLE stock');
    }
}
