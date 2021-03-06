<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190611155138 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hashtag (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_original_name VARCHAR(255) DEFAULT NULL, image_mime_type VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, image_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', image2_name VARCHAR(255) DEFAULT NULL, image2_original_name VARCHAR(255) DEFAULT NULL, image2_mime_type VARCHAR(255) DEFAULT NULL, image2_size INT DEFAULT NULL, image2_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', image3_name VARCHAR(255) DEFAULT NULL, image3_original_name VARCHAR(255) DEFAULT NULL, image3_mime_type VARCHAR(255) DEFAULT NULL, image3_size INT DEFAULT NULL, image3_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_hashtag (produit_id INT NOT NULL, hashtag_id INT NOT NULL, INDEX IDX_9C4EA118F347EFB (produit_id), INDEX IDX_9C4EA118FB34EF56 (hashtag_id), PRIMARY KEY(produit_id, hashtag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit_hashtag ADD CONSTRAINT FK_9C4EA118F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_hashtag ADD CONSTRAINT FK_9C4EA118FB34EF56 FOREIGN KEY (hashtag_id) REFERENCES hashtag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit_hashtag DROP FOREIGN KEY FK_9C4EA118FB34EF56');
        $this->addSql('ALTER TABLE produit_hashtag DROP FOREIGN KEY FK_9C4EA118F347EFB');
        $this->addSql('DROP TABLE hashtag');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_hashtag');
    }
}
