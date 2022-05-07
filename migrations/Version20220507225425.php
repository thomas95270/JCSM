<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220507225425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE licencie CHANGE cotisation cotisation enum(\'encaisse\', \'paye\', \'en attente\')');
        $this->addSql('ALTER TABLE personne ADD nom VARCHAR(50) NOT NULL, ADD prenom VARCHAR(50) NOT NULL, ADD email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FCEC9EFE7927C74 ON personne (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE licencie CHANGE cotisation cotisation VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_FCEC9EFE7927C74 ON personne');
        $this->addSql('ALTER TABLE personne DROP nom, DROP prenom, DROP email');
    }
}
