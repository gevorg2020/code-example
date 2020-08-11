<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200416202605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE public.food_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.exercise_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.training_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.nutrition_id_seq INCREMENT BY 1 MINVALUE 1 START 1');

        $this->addSql('CREATE TABLE public.food (
                                id SERIAL NOT NULL,
                                nutrition_id INT DEFAULT NULL,
                                name TEXT NOT NULL,
                                count INT NOT NULL,
                                PRIMARY KEY(id)
                            )');
        $this->addSql('CREATE INDEX IDX_6BD7A259B5D724CD ON public.food (nutrition_id)');
        $this->addSql('CREATE TABLE public.exercise (
                                id SERIAL NOT NULL,
                                training_id INT DEFAULT NULL,
                                name VARCHAR(255) NOT NULL,
                                description TEXT NOT NULL,
                                video_path VARCHAR (255),
                                PRIMARY KEY(id)
                            )');
        $this->addSql('CREATE INDEX IDX_6C360E75BEFD98D1 ON public.exercise (training_id)');
        $this->addSql('CREATE TABLE public.training (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE public.nutrition (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, week_day INT NOT NULL, mill INT NOT NULL, calories INT NOT NULL, protein INT NOT NULL, PRIMARY KEY(id))');

        $this->addSql('ALTER TABLE public.food ADD CONSTRAINT FK_6BD7A259B5D724CD FOREIGN KEY (nutrition_id) REFERENCES public.nutrition (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public.exercise ADD CONSTRAINT FK_6C360E75BEFD98D1 FOREIGN KEY (training_id) REFERENCES public.training (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE public.food DROP CONSTRAINT FK_6BD7A259B5D724CD');

        $this->addSql('DROP SEQUENCE public.food_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.exercise_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.training_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.nutrition_id_seq CASCADE');

        $this->addSql('DROP TABLE public.food');
        $this->addSql('DROP TABLE public.exercise');
        $this->addSql('DROP TABLE public.training');
        $this->addSql('DROP TABLE public.nutrition');
    }
}
