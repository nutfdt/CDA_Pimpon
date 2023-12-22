<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231222010041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervention_pompier (intervention_id INT NOT NULL, pompier_id INT NOT NULL, INDEX IDX_2852AA828EAE3863 (intervention_id), INDEX IDX_2852AA8217801440 (pompier_id), PRIMARY KEY(intervention_id, pompier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intervention_pompier ADD CONSTRAINT FK_2852AA828EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_pompier ADD CONSTRAINT FK_2852AA8217801440 FOREIGN KEY (pompier_id) REFERENCES pompier (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention_pompier DROP FOREIGN KEY FK_2852AA828EAE3863');
        $this->addSql('ALTER TABLE intervention_pompier DROP FOREIGN KEY FK_2852AA8217801440');
        $this->addSql('DROP TABLE intervention_pompier');
    }
}
