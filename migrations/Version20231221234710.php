<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231221234710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(150) NOT NULL, cout INT NOT NULL, adresse VARCHAR(150) NOT NULL, date DATE NOT NULL, heure TIME NOT NULL, duree INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_pompier (formation_id INT NOT NULL, pompier_id INT NOT NULL, INDEX IDX_26439B9C5200282E (formation_id), INDEX IDX_26439B9C17801440 (pompier_id), PRIMARY KEY(formation_id, pompier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation_pompier ADD CONSTRAINT FK_26439B9C5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_pompier ADD CONSTRAINT FK_26439B9C17801440 FOREIGN KEY (pompier_id) REFERENCES pompier (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation_pompier DROP FOREIGN KEY FK_26439B9C5200282E');
        $this->addSql('ALTER TABLE formation_pompier DROP FOREIGN KEY FK_26439B9C17801440');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_pompier');
    }
}
