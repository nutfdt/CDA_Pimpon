<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231222001618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pompier ADD id_caserne_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pompier ADD CONSTRAINT FK_63BCDEE7398949F1 FOREIGN KEY (id_caserne_id) REFERENCES caserne (id)');
        $this->addSql('CREATE INDEX IDX_63BCDEE7398949F1 ON pompier (id_caserne_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pompier DROP FOREIGN KEY FK_63BCDEE7398949F1');
        $this->addSql('DROP INDEX IDX_63BCDEE7398949F1 ON pompier');
        $this->addSql('ALTER TABLE pompier DROP id_caserne_id');
    }
}
