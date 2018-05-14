<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180514140005 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artwork ADD title VARCHAR(255) NOT NULL, ADD slug VARCHAR(128) NOT NULL, ADD series VARCHAR(255) NOT NULL, ADD year INT NOT NULL, ADD position VARCHAR(255) NOT NULL, ADD image VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_881FC576989D9B62 ON artwork (slug)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_881FC576989D9B62 ON artwork');
        $this->addSql('ALTER TABLE artwork DROP title, DROP slug, DROP series, DROP year, DROP position, DROP image, CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL');
    }
}
