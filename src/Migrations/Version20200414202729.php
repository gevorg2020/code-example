<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200414202729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE public.country_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.city_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE public.country (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE public.city (id SERIAL NOT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_92B4899AF92F3E70 ON public.city (country_id)');
        $this->addSql('CREATE TABLE public."user" (id SERIAL NOT NULL, city_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, second_name VARCHAR(255) DEFAULT NULL, height DOUBLE PRECISION DEFAULT NULL, weight DOUBLE PRECISION DEFAULT NULL, sex INT DEFAULT NULL, birthday DATE DEFAULT NULL, age INT DEFAULT NULL, phone BIGINT DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, post_code VARCHAR(255) DEFAULT NULL, create_at VARCHAR(255) DEFAULT NULL, update_at VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_327C5DE7E7927C74 ON public."user" (email)');
        $this->addSql('CREATE INDEX IDX_327C5DE78BAC62AF ON public."user" (city_id)');
        $this->addSql('ALTER TABLE public.city ADD CONSTRAINT FK_92B4899AF92F3E70 FOREIGN KEY (country_id) REFERENCES public.country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public."user" ADD CONSTRAINT FK_327C5DE78BAC62AF FOREIGN KEY (city_id) REFERENCES public.city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE public.city DROP CONSTRAINT FK_92B4899AF92F3E70');
        $this->addSql('ALTER TABLE public."user" DROP CONSTRAINT FK_327C5DE78BAC62AF');
        $this->addSql('DROP SEQUENCE public.country_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.city_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.user_id_seq CASCADE');
        $this->addSql('DROP TABLE public.country');
        $this->addSql('DROP TABLE public.city');
        $this->addSql('DROP TABLE public."user"');
    }
}
