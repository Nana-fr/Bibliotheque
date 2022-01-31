<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131152049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, email VARCHAR(60) DEFAULT NULL, card_number INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book CHANGE writerId writerId INT UNSIGNED DEFAULT NULL, CHANGE languageId languageId INT UNSIGNED DEFAULT NULL, CHANGE categoryId categoryId INT UNSIGNED DEFAULT NULL, CHANGE statusId statusId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE writer CHANGE nationalityId nationalityId INT UNSIGNED DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE book CHANGE title title VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE plot plot TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE publication_date publication_date VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE writerId writerId INT UNSIGNED NOT NULL, CHANGE categoryId categoryId INT UNSIGNED NOT NULL, CHANGE statusId statusId INT UNSIGNED NOT NULL, CHANGE languageId languageId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE language CHANGE name name VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE nationality CHANGE name name VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE status CHANGE name name VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE writer CHANGE firstname firstname VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE lastname lastname VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE nationalityId nationalityId INT UNSIGNED NOT NULL');
    }
}
