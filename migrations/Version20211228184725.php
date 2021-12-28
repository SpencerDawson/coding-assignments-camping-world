<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228184725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initialization of DB.';
    }

    public function up(Schema $schema): void
    {
        // Generate documents Table
        $this->addSql("CREATE TABLE IF NOT EXISTS documents (
            id INT NOT NULL,
            name varchar(250) NOT NULL,
            path varchar(260) NOT NULL,
            type varchar(16) NOT NULL,
            create_at TIMESTAMP NOT NULL,
            update_at TIMESTAMP NULL,
            PRIMARY KEY (id)
            )");

        // Generate campers Table
        $this->addSql("CREATE TABLE IF NOT EXISTS campers (
            id INT NOT NULL,
            doc_id INT NOT NULL,
            make varchar(250) NULL,
            brand varchar(250) NULL,
            capacity INT NULL,
            price INT NULL,
            create_at TIMESTAMP NOT NULL,
            update_at TIMESTAMP NULL,
            PRIMARY KEY (id),
            CONSTRAINT fk_doc_id FOREIGN KEY (doc_id) REFERENCES documents (id)
            )");
        
        // create sequences
        $this->addSql("CREATE SEQUENCE documents_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE campers_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP SEQUENCE IF EXISTS documents_id_seq");
        $this->addSql("DROP SEQUENCE IF EXISTS campers_id_seq");
        $this->addSql("DROP TABLE IF EXISTS campers");
        $this->addSql("DROP TABLE IF EXISTS camperdocumentss_id_seq");
    }
}
