<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231222003124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE caserne_equipement (caserne_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_E69F87C89C03C926 (caserne_id), INDEX IDX_E69F87C8806F0F5C (equipement_id), PRIMARY KEY(caserne_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE caserne_equipement ADD CONSTRAINT FK_E69F87C89C03C926 FOREIGN KEY (caserne_id) REFERENCES caserne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caserne_equipement ADD CONSTRAINT FK_E69F87C8806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caserne_equipement DROP FOREIGN KEY FK_E69F87C89C03C926');
        $this->addSql('ALTER TABLE caserne_equipement DROP FOREIGN KEY FK_E69F87C8806F0F5C');
        $this->addSql('DROP TABLE caserne_equipement');
    }
}
