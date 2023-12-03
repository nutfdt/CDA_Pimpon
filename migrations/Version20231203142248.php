<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231203142248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detail_intervention (id INT AUTO_INCREMENT NOT NULL, id_intervention_id INT DEFAULT NULL, id_pompier_id INT DEFAULT NULL, id_vehicule_id INT DEFAULT NULL, heure_debut VARCHAR(20) NOT NULL, heure_fin VARCHAR(20) NOT NULL, INDEX IDX_CD1B7EA467F0FBEB (id_intervention_id), INDEX IDX_CD1B7EA4B20A9497 (id_pompier_id), INDEX IDX_CD1B7EA45258F8E6 (id_vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detail_intervention ADD CONSTRAINT FK_CD1B7EA467F0FBEB FOREIGN KEY (id_intervention_id) REFERENCES intervention (id)');
        $this->addSql('ALTER TABLE detail_intervention ADD CONSTRAINT FK_CD1B7EA4B20A9497 FOREIGN KEY (id_pompier_id) REFERENCES pompier (id)');
        $this->addSql('ALTER TABLE detail_intervention ADD CONSTRAINT FK_CD1B7EA45258F8E6 FOREIGN KEY (id_vehicule_id) REFERENCES vehicule (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_intervention DROP FOREIGN KEY FK_CD1B7EA467F0FBEB');
        $this->addSql('ALTER TABLE detail_intervention DROP FOREIGN KEY FK_CD1B7EA4B20A9497');
        $this->addSql('ALTER TABLE detail_intervention DROP FOREIGN KEY FK_CD1B7EA45258F8E6');
        $this->addSql('DROP TABLE detail_intervention');
    }
}
