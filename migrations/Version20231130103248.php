<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231130103248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, nom_id INT DEFAULT NULL, lieu VARCHAR(255) NOT NULL, date_voyage DATETIME NOT NULL, INDEX IDX_3EC63EAAC8121CE9 (nom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE duree_sejour (id INT AUTO_INCREMENT NOT NULL, duree VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE duree_sejour_passager (duree_sejour_id INT NOT NULL, passager_id INT NOT NULL, INDEX IDX_61EEF2319CDD2F46 (duree_sejour_id), INDEX IDX_61EEF23171A51189 (passager_id), PRIMARY KEY(duree_sejour_id, passager_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_de_recherche (id INT AUTO_INCREMENT NOT NULL, motif VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, postnom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATETIME NOT NULL, lieu_naissace VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_voyage (id INT AUTO_INCREMENT NOT NULL, type_voyage VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_voyage_passager (type_voyage_id INT NOT NULL, passager_id INT NOT NULL, INDEX IDX_6982C7B1DC0FA4BF (type_voyage_id), INDEX IDX_6982C7B171A51189 (passager_id), PRIMARY KEY(type_voyage_id, passager_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_voyage_destination (type_voyage_id INT NOT NULL, destination_id INT NOT NULL, INDEX IDX_6AB3DDD8DC0FA4BF (type_voyage_id), INDEX IDX_6AB3DDD8816C6140 (destination_id), PRIMARY KEY(type_voyage_id, destination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE destination ADD CONSTRAINT FK_3EC63EAAC8121CE9 FOREIGN KEY (nom_id) REFERENCES passager (id)');
        $this->addSql('ALTER TABLE duree_sejour_passager ADD CONSTRAINT FK_61EEF2319CDD2F46 FOREIGN KEY (duree_sejour_id) REFERENCES duree_sejour (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE duree_sejour_passager ADD CONSTRAINT FK_61EEF23171A51189 FOREIGN KEY (passager_id) REFERENCES passager (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_voyage_passager ADD CONSTRAINT FK_6982C7B1DC0FA4BF FOREIGN KEY (type_voyage_id) REFERENCES type_voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_voyage_passager ADD CONSTRAINT FK_6982C7B171A51189 FOREIGN KEY (passager_id) REFERENCES passager (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_voyage_destination ADD CONSTRAINT FK_6AB3DDD8DC0FA4BF FOREIGN KEY (type_voyage_id) REFERENCES type_voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_voyage_destination ADD CONSTRAINT FK_6AB3DDD8816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE destination DROP FOREIGN KEY FK_3EC63EAAC8121CE9');
        $this->addSql('ALTER TABLE duree_sejour_passager DROP FOREIGN KEY FK_61EEF2319CDD2F46');
        $this->addSql('ALTER TABLE duree_sejour_passager DROP FOREIGN KEY FK_61EEF23171A51189');
        $this->addSql('ALTER TABLE type_voyage_passager DROP FOREIGN KEY FK_6982C7B1DC0FA4BF');
        $this->addSql('ALTER TABLE type_voyage_passager DROP FOREIGN KEY FK_6982C7B171A51189');
        $this->addSql('ALTER TABLE type_voyage_destination DROP FOREIGN KEY FK_6AB3DDD8DC0FA4BF');
        $this->addSql('ALTER TABLE type_voyage_destination DROP FOREIGN KEY FK_6AB3DDD8816C6140');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE duree_sejour');
        $this->addSql('DROP TABLE duree_sejour_passager');
        $this->addSql('DROP TABLE liste_de_recherche');
        $this->addSql('DROP TABLE type_voyage');
        $this->addSql('DROP TABLE type_voyage_passager');
        $this->addSql('DROP TABLE type_voyage_destination');
    }
}
