<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220203160719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clues (id INT AUTO_INCREMENT NOT NULL, wilder_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_EAFCA7E46BF8E6F7 (wilder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wilder (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, promo VARCHAR(255) NOT NULL, hair TINYINT(1) DEFAULT NULL, reconversion TINYINT(1) DEFAULT NULL, glasses TINYINT(1) DEFAULT NULL, beard TINYINT(1) DEFAULT NULL, long_hair TINYINT(1) DEFAULT NULL, children TINYINT(1) DEFAULT NULL, portrait VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clues ADD CONSTRAINT FK_EAFCA7E46BF8E6F7 FOREIGN KEY (wilder_id) REFERENCES wilder (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clues DROP FOREIGN KEY FK_EAFCA7E46BF8E6F7');
        $this->addSql('DROP TABLE clues');
        $this->addSql('DROP TABLE wilder');
    }
}
