<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241014131254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alumni (id INT AUTO_INCREMENT NOT NULL, ref_etudiant_id INT NOT NULL, entreprise VARCHAR(255) NOT NULL, poste VARCHAR(255) NOT NULL, INDEX IDX_FD56701827E3492F (ref_etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, ref_utilisateur_id INT NOT NULL, poste_entreprise VARCHAR(255) NOT NULL, fiche_entreprise LONGBLOB NOT NULL, INDEX IDX_D19FA60B61ED040 (ref_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, ref_utilisateur_id INT NOT NULL, annee_promo DATE NOT NULL, cv LONGBLOB NOT NULL, poste_entreprise VARCHAR(255) NOT NULL, INDEX IDX_717E22E3B61ED040 (ref_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, ref_professeur_id INT NOT NULL, ref_entreprise_id INT NOT NULL, titre_evenement VARCHAR(255) NOT NULL, description VARCHAR(2048) NOT NULL, lieu VARCHAR(255) NOT NULL, nombre_places INT NOT NULL, date_evenement DATE NOT NULL, type_evenement VARCHAR(255) NOT NULL, INDEX IDX_B26681E9EE27989 (ref_professeur_id), INDEX IDX_B26681E80FEF88A (ref_entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link_etudiant_evenement (id INT AUTO_INCREMENT NOT NULL, ref_etudiant_id INT NOT NULL, INDEX IDX_8B232CA927E3492F (ref_etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link_etudiant_offre (id INT AUTO_INCREMENT NOT NULL, ref_offre_id INT NOT NULL, ref_etudiant_id INT NOT NULL, date DATE NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_C4C86E30CADF96DD (ref_offre_id), INDEX IDX_C4C86E3027E3492F (ref_etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, ref_entreprise_id INT NOT NULL, titre_offre VARCHAR(255) NOT NULL, description VARCHAR(2048) NOT NULL, type_offre VARCHAR(255) NOT NULL, etat_offre VARCHAR(255) NOT NULL, date_publication DATE NOT NULL, INDEX IDX_AF86866F80FEF88A (ref_entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, ref_utilisateur_id INT NOT NULL, contenu_post VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, date_heure_publication DATETIME NOT NULL, canal VARCHAR(255) NOT NULL, INDEX IDX_5A8A6C8DB61ED040 (ref_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, ref_utilisateur_id INT NOT NULL, discipline VARCHAR(255) NOT NULL, formation VARCHAR(255) NOT NULL, INDEX IDX_17A55299B61ED040 (ref_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, ref_post_id INT NOT NULL, contenu VARCHAR(2048) NOT NULL, date_heure_reponse DATETIME NOT NULL, INDEX IDX_5FB6DEC78F9D50FC (ref_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alumni ADD CONSTRAINT FK_FD56701827E3492F FOREIGN KEY (ref_etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60B61ED040 FOREIGN KEY (ref_utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3B61ED040 FOREIGN KEY (ref_utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E9EE27989 FOREIGN KEY (ref_professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E80FEF88A FOREIGN KEY (ref_entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE link_etudiant_evenement ADD CONSTRAINT FK_8B232CA927E3492F FOREIGN KEY (ref_etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE link_etudiant_offre ADD CONSTRAINT FK_C4C86E30CADF96DD FOREIGN KEY (ref_offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE link_etudiant_offre ADD CONSTRAINT FK_C4C86E3027E3492F FOREIGN KEY (ref_etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F80FEF88A FOREIGN KEY (ref_entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DB61ED040 FOREIGN KEY (ref_utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299B61ED040 FOREIGN KEY (ref_utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC78F9D50FC FOREIGN KEY (ref_post_id) REFERENCES post (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alumni DROP FOREIGN KEY FK_FD56701827E3492F');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60B61ED040');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3B61ED040');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E9EE27989');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E80FEF88A');
        $this->addSql('ALTER TABLE link_etudiant_evenement DROP FOREIGN KEY FK_8B232CA927E3492F');
        $this->addSql('ALTER TABLE link_etudiant_offre DROP FOREIGN KEY FK_C4C86E30CADF96DD');
        $this->addSql('ALTER TABLE link_etudiant_offre DROP FOREIGN KEY FK_C4C86E3027E3492F');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F80FEF88A');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DB61ED040');
        $this->addSql('ALTER TABLE professeur DROP FOREIGN KEY FK_17A55299B61ED040');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC78F9D50FC');
        $this->addSql('DROP TABLE alumni');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE link_etudiant_evenement');
        $this->addSql('DROP TABLE link_etudiant_offre');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
