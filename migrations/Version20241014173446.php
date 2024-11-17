<?php
declare(strict_types=1);
namespace DoctrineMigrations;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241014173446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
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
        $this->addSql('ALTER TABLE professeur DROP FOREIGN KEY FK_17A55299B61ED040');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DB61ED040');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC78F9D50FC');
        $this->addSql('ALTER TABLE link_etudiant_evenement DROP FOREIGN KEY FK_8B232CA927E3492F');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60B61ED040');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E9EE27989');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E80FEF88A');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F80FEF88A');
        $this->addSql('ALTER TABLE link_etudiant_offre DROP FOREIGN KEY FK_C4C86E30CADF96DD');
        $this->addSql('ALTER TABLE link_etudiant_offre DROP FOREIGN KEY FK_C4C86E3027E3492F');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3B61ED040');
    }
}