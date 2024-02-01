<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201205707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skills_projects (skills_id INT NOT NULL, projects_id INT NOT NULL, INDEX IDX_74C32EC77FF61858 (skills_id), INDEX IDX_74C32EC71EDE0F55 (projects_id), PRIMARY KEY(skills_id, projects_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE skills_projects ADD CONSTRAINT FK_74C32EC77FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skills_projects ADD CONSTRAINT FK_74C32EC71EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skills_projects DROP FOREIGN KEY FK_74C32EC77FF61858');
        $this->addSql('ALTER TABLE skills_projects DROP FOREIGN KEY FK_74C32EC71EDE0F55');
        $this->addSql('DROP TABLE skills_projects');
    }
}
