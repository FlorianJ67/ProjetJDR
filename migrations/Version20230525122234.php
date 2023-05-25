<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525122234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, perso_id INT DEFAULT NULL, item_id INT DEFAULT NULL, INDEX IDX_47CC8C92613FECDF (session_id), INDEX IDX_47CC8C921221E019 (perso_id), INDEX IDX_47CC8C92126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique_contenu (id INT AUTO_INCREMENT NOT NULL, caracteristique_id INT NOT NULL, is_main TINYINT(1) NOT NULL, value_max INT DEFAULT NULL, INDEX IDX_C90AA2631704EEB7 (caracteristique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique_contenu_collection_caracteristique (caracteristique_contenu_id INT NOT NULL, collection_caracteristique_id INT NOT NULL, INDEX IDX_6540D989503487F5 (caracteristique_contenu_id), INDEX IDX_6540D9899EC000E2 (collection_caracteristique_id), PRIMARY KEY(caracteristique_contenu_id, collection_caracteristique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique_perso (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, caracteristique_id INT NOT NULL, perso_id INT NOT NULL, value_caracteristique DOUBLE PRECISION DEFAULT NULL, INDEX IDX_A3E653BF613FECDF (session_id), INDEX IDX_A3E653BF1704EEB7 (caracteristique_id), INDEX IDX_A3E653BF1221E019 (perso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collection_caracteristique (id INT AUTO_INCREMENT NOT NULL, is_main TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collection_competence (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collection_competence_competence (collection_competence_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_8CD7E491CE57F764 (collection_competence_id), INDEX IDX_8CD7E49115761DAB (competence_id), PRIMARY KEY(collection_competence_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, competence_value DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence_character (id INT AUTO_INCREMENT NOT NULL, perso_id INT NOT NULL, competence_id INT NOT NULL, session_id INT DEFAULT NULL, value_competence DOUBLE PRECISION DEFAULT NULL, INDEX IDX_A7CFC6491221E019 (perso_id), INDEX IDX_A7CFC64915761DAB (competence_id), INDEX IDX_A7CFC649613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, item_value INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_character (item_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_9FA0A6C4126F525E (item_id), INDEX IDX_9FA0A6C41136BE75 (character_id), PRIMARY KEY(item_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lien_competence_caracteristique (id INT AUTO_INCREMENT NOT NULL, caracteristique_id INT NOT NULL, INDEX IDX_4D1AEDD51704EEB7 (caracteristique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lien_competence_caracteristique_competence (lien_competence_caracteristique_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_C0FD45ECFBB1467D (lien_competence_caracteristique_id), INDEX IDX_C0FD45EC15761DAB (competence_id), PRIMARY KEY(lien_competence_caracteristique_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lien_competence_caracteristique_session (lien_competence_caracteristique_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_8AA83603FBB1467D (lien_competence_caracteristique_id), INDEX IDX_8AA83603613FECDF (session_id), PRIMARY KEY(lien_competence_caracteristique_id, session_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, session_id INT NOT NULL, content VARCHAR(255) NOT NULL, creation_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_B6BD307FF675F31B (author_id), INDEX IDX_B6BD307F613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, game_master_id INT NOT NULL, collection_competence_id INT DEFAULT NULL, collection_caracteristique_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_D044D5D4C1151A13 (game_master_id), INDEX IDX_D044D5D4CE57F764 (collection_competence_id), INDEX IDX_D044D5D49EC000E2 (collection_caracteristique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C92613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C921221E019 FOREIGN KEY (perso_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C92126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE caracteristique_contenu ADD CONSTRAINT FK_C90AA2631704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id)');
        $this->addSql('ALTER TABLE caracteristique_contenu_collection_caracteristique ADD CONSTRAINT FK_6540D989503487F5 FOREIGN KEY (caracteristique_contenu_id) REFERENCES caracteristique_contenu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caracteristique_contenu_collection_caracteristique ADD CONSTRAINT FK_6540D9899EC000E2 FOREIGN KEY (collection_caracteristique_id) REFERENCES collection_caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caracteristique_perso ADD CONSTRAINT FK_A3E653BF613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE caracteristique_perso ADD CONSTRAINT FK_A3E653BF1704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id)');
        $this->addSql('ALTER TABLE caracteristique_perso ADD CONSTRAINT FK_A3E653BF1221E019 FOREIGN KEY (perso_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE collection_competence_competence ADD CONSTRAINT FK_8CD7E491CE57F764 FOREIGN KEY (collection_competence_id) REFERENCES collection_competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE collection_competence_competence ADD CONSTRAINT FK_8CD7E49115761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_character ADD CONSTRAINT FK_A7CFC6491221E019 FOREIGN KEY (perso_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE competence_character ADD CONSTRAINT FK_A7CFC64915761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
        $this->addSql('ALTER TABLE competence_character ADD CONSTRAINT FK_A7CFC649613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE item_character ADD CONSTRAINT FK_9FA0A6C4126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_character ADD CONSTRAINT FK_9FA0A6C41136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lien_competence_caracteristique ADD CONSTRAINT FK_4D1AEDD51704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id)');
        $this->addSql('ALTER TABLE lien_competence_caracteristique_competence ADD CONSTRAINT FK_C0FD45ECFBB1467D FOREIGN KEY (lien_competence_caracteristique_id) REFERENCES lien_competence_caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lien_competence_caracteristique_competence ADD CONSTRAINT FK_C0FD45EC15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lien_competence_caracteristique_session ADD CONSTRAINT FK_8AA83603FBB1467D FOREIGN KEY (lien_competence_caracteristique_id) REFERENCES lien_competence_caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lien_competence_caracteristique_session ADD CONSTRAINT FK_8AA83603613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF675F31B FOREIGN KEY (author_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4C1151A13 FOREIGN KEY (game_master_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4CE57F764 FOREIGN KEY (collection_competence_id) REFERENCES collection_competence (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D49EC000E2 FOREIGN KEY (collection_caracteristique_id) REFERENCES collection_caracteristique (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C92613FECDF');
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C921221E019');
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C92126F525E');
        $this->addSql('ALTER TABLE caracteristique_contenu DROP FOREIGN KEY FK_C90AA2631704EEB7');
        $this->addSql('ALTER TABLE caracteristique_contenu_collection_caracteristique DROP FOREIGN KEY FK_6540D989503487F5');
        $this->addSql('ALTER TABLE caracteristique_contenu_collection_caracteristique DROP FOREIGN KEY FK_6540D9899EC000E2');
        $this->addSql('ALTER TABLE caracteristique_perso DROP FOREIGN KEY FK_A3E653BF613FECDF');
        $this->addSql('ALTER TABLE caracteristique_perso DROP FOREIGN KEY FK_A3E653BF1704EEB7');
        $this->addSql('ALTER TABLE caracteristique_perso DROP FOREIGN KEY FK_A3E653BF1221E019');
        $this->addSql('ALTER TABLE collection_competence_competence DROP FOREIGN KEY FK_8CD7E491CE57F764');
        $this->addSql('ALTER TABLE collection_competence_competence DROP FOREIGN KEY FK_8CD7E49115761DAB');
        $this->addSql('ALTER TABLE competence_character DROP FOREIGN KEY FK_A7CFC6491221E019');
        $this->addSql('ALTER TABLE competence_character DROP FOREIGN KEY FK_A7CFC64915761DAB');
        $this->addSql('ALTER TABLE competence_character DROP FOREIGN KEY FK_A7CFC649613FECDF');
        $this->addSql('ALTER TABLE item_character DROP FOREIGN KEY FK_9FA0A6C4126F525E');
        $this->addSql('ALTER TABLE item_character DROP FOREIGN KEY FK_9FA0A6C41136BE75');
        $this->addSql('ALTER TABLE lien_competence_caracteristique DROP FOREIGN KEY FK_4D1AEDD51704EEB7');
        $this->addSql('ALTER TABLE lien_competence_caracteristique_competence DROP FOREIGN KEY FK_C0FD45ECFBB1467D');
        $this->addSql('ALTER TABLE lien_competence_caracteristique_competence DROP FOREIGN KEY FK_C0FD45EC15761DAB');
        $this->addSql('ALTER TABLE lien_competence_caracteristique_session DROP FOREIGN KEY FK_8AA83603FBB1467D');
        $this->addSql('ALTER TABLE lien_competence_caracteristique_session DROP FOREIGN KEY FK_8AA83603613FECDF');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF675F31B');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F613FECDF');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4C1151A13');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4CE57F764');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D49EC000E2');
        $this->addSql('DROP TABLE action');
        $this->addSql('DROP TABLE caracteristique');
        $this->addSql('DROP TABLE caracteristique_contenu');
        $this->addSql('DROP TABLE caracteristique_contenu_collection_caracteristique');
        $this->addSql('DROP TABLE caracteristique_perso');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE collection_caracteristique');
        $this->addSql('DROP TABLE collection_competence');
        $this->addSql('DROP TABLE collection_competence_competence');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE competence_character');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_character');
        $this->addSql('DROP TABLE lien_competence_caracteristique');
        $this->addSql('DROP TABLE lien_competence_caracteristique_competence');
        $this->addSql('DROP TABLE lien_competence_caracteristique_session');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
