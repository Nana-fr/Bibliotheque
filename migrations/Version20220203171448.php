<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220203171448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD availability TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE borrowing CHANGE returning_date returning_date DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP availability, CHANGE title title VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE plot plot TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE publication_date publication_date VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE borrowing CHANGE returning_date returning_date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE language CHANGE name name VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE nationality CHANGE name name VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE status CHANGE name name VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE firstname firstname VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lastname lastname VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(60) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE writer CHANGE firstname firstname VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE lastname lastname VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
    }
}
