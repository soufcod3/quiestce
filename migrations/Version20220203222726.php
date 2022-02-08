<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220203222726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wilder DROP promo, DROP hair, DROP reconversion, DROP glasses, DROP beard, DROP long_hair, DROP children, DROP portrait');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clues CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE question CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE answer answer VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE wilder ADD promo VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD hair TINYINT(1) DEFAULT NULL, ADD reconversion TINYINT(1) DEFAULT NULL, ADD glasses TINYINT(1) DEFAULT NULL, ADD beard TINYINT(1) DEFAULT NULL, ADD long_hair TINYINT(1) DEFAULT NULL, ADD children TINYINT(1) DEFAULT NULL, ADD portrait VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
