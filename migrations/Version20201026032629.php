<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026032629 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, article_section_id INT NOT NULL, name VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, post_date DATETIME NOT NULL, views INT NOT NULL, likes INT NOT NULL, INDEX IDX_23A0E66E4FA32FB (article_section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_section (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_section (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_1F4257457294869C (article_id), INDEX IDX_1F425745BAD26311 (tag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66E4FA32FB FOREIGN KEY (article_section_id) REFERENCES article_section (id)');
        $this->addSql('ALTER TABLE tag_section ADD CONSTRAINT FK_1F4257457294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE tag_section ADD CONSTRAINT FK_1F425745BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tag_section DROP FOREIGN KEY FK_1F4257457294869C');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66E4FA32FB');
        $this->addSql('ALTER TABLE tag_section DROP FOREIGN KEY FK_1F425745BAD26311');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_section');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_section');
    }
}
