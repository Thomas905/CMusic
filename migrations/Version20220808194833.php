<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220808194833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestation DROP date');
        $this->addSql('ALTER TABLE prestation CHANGE paymentstatus paymentstatus VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE prestation ADD color VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestation ADD date DATE NOT NULL');
        $this->addSql('ALTER TABLE prestation CHANGE paymentstatus paymentstatus TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE prestation DROP color');
    }
}
