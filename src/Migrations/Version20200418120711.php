<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200418120711 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );

        $this->addSql('ALTER TABLE public.nutrition DROP COLUMN week_day');
        $this->addSql('ALTER TABLE public.exercise DROP CONSTRAINT FK_6C360E75BEFD98D1');
        $this->addSql('ALTER TABLE public.exercise DROP COLUMN training_id');

        $this->addSql('CREATE SEQUENCE public.training_nutrition_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE public.training_nutrition (id SERIAL NOT NULL, training_id INT NOT NULL, nutrition_id INT NOT NULL, week_day INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ED124DD7BEFD98D1 ON public.training_nutrition (training_id, nutrition_id)');
        $this->addSql('ALTER TABLE public.training_nutrition ADD CONSTRAINT FK_ED124DD7BEFD98D1 FOREIGN KEY (training_id) REFERENCES public.training (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public.training_nutrition ADD CONSTRAINT FK_ED124DD7B5D724CD FOREIGN KEY (nutrition_id) REFERENCES public.nutrition (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('CREATE SEQUENCE public.user_training_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE public.user_training (id SERIAL NOT NULL, training_id INT NOT NULL, user_id INT NOT NULL, week_day INT CHECK(week_day >0 AND week_day<8), PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9DCD923BEFD98D1 ON public.user_training (training_id, user_id)');
        $this->addSql('ALTER TABLE public.user_training ADD CONSTRAINT FK_9DCD923BEFD98D1 FOREIGN KEY (training_id) REFERENCES public.training (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public.user_training ADD CONSTRAINT FK_9DCD923A76ED395 FOREIGN KEY (user_id) REFERENCES public."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('CREATE SEQUENCE public.training_exercise_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE public.training_exercise (id SERIAL NOT NULL, training_id INT NOT NULL, exercise_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EDCDDSERDSER12 ON public.training_exercise (training_id, exercise_id)');
        $this->addSql('ALTER TABLE public.training_exercise ADD CONSTRAINT FK_training_exercise_training_id FOREIGN KEY (training_id) REFERENCES public.training (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public.training_exercise ADD CONSTRAINT FK_training_exercise_exercise_id FOREIGN KEY (exercise_id) REFERENCES public.exercise (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('CREATE SEQUENCE public.exercise_video_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE public.exercise_video (id SERIAL NOT NULL, exercise_id INT NOT NULL, user_training_id INT NOT NULL, video_path VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_86AD819AE934951A ON public.exercise_video (exercise_id, user_training_id)');
        $this->addSql('ALTER TABLE public.exercise_video ADD CONSTRAINT FK_exercise_video_exercise_id FOREIGN KEY (exercise_id) REFERENCES public.exercise (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public.exercise_video ADD CONSTRAINT FK_exercise_video_user_training_id FOREIGN KEY (user_training_id) REFERENCES public.user_training (id) NOT DEFERRABLE INITIALLY IMMEDIATE');


        $this->addSql('CREATE SEQUENCE public.user_nutrition_training_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE public.user_nutrition_training (
                                id SERIAL NOT NULL,
                                training_id INT NOT NULL,
                                nutrition_id INT NOT NULL,
                                user_id INT NOT NULL,
                                PRIMARY KEY(id))'
        );
        $this->addSql('CREATE UNIQUE INDEX UNIQ_user_nutrition_training ON public.user_nutrition_training (
                                training_id,
                                nutrition_id,
                                user_id)'
        );
        $this->addSql('ALTER TABLE public.user_nutrition_training ADD CONSTRAINT 
                                       fk_user_nutrition_training_training_id FOREIGN KEY 
                                       (training_id) REFERENCES 
                                       public.training (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
        $this->addSql('ALTER TABLE public.user_nutrition_training ADD CONSTRAINT 
                                        fk_user_nutrition_training_nutrition_id FOREIGN KEY 
                                        (nutrition_id) REFERENCES 
                                        public.nutrition (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
        $this->addSql('ALTER TABLE public.user_nutrition_training ADD CONSTRAINT 
                                        fk_user_nutrition_training_user_id FOREIGN KEY 
                                        (user_id) REFERENCES 
                                        public.user (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
        );

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );

        $this->addSql('ALTER TABLE public.exercise_video DROP CONSTRAINT FK_exercise_video_exercise_id');
        $this->addSql('ALTER TABLE public.exercise_video DROP CONSTRAINT FK_exercise_video_user_training_id');
        $this->addSql('DROP SEQUENCE public.exercise_video_id_seq CASCADE');
        $this->addSql('DROP TABLE public.exercise_video');

        $this->addSql('ALTER TABLE public.training_nutrition DROP CONSTRAINT FK_ED124DD7BEFD98D1');
        $this->addSql('ALTER TABLE public.training_nutrition DROP CONSTRAINT FK_ED124DD7B5D724CD');
        $this->addSql('DROP SEQUENCE public.training_nutrition_id_seq CASCADE');
        $this->addSql('DROP TABLE public.training_nutrition');

        $this->addSql('ALTER TABLE public.user_training DROP CONSTRAINT FK_9DCD923A76ED395');
        $this->addSql('ALTER TABLE public.user_training DROP CONSTRAINT FK_9DCD923BEFD98D1');
        $this->addSql('DROP SEQUENCE public.user_training_id_seq CASCADE');
        $this->addSql('DROP TABLE public.user_training');

        $this->addSql('ALTER TABLE public.training_exercise DROP CONSTRAINT FK_training_exercise_training_id');
        $this->addSql('ALTER TABLE public.training_exercise DROP CONSTRAINT FK_training_exercise_exercise_id');
        $this->addSql('DROP SEQUENCE public.training_exercise_id_seq CASCADE');
        $this->addSql('DROP TABLE public.training_exercise');

        $this->addSql('ALTER TABLE public.user_nutrition_training DROP CONSTRAINT fk_user_nutrition_training_training_id');
        $this->addSql('ALTER TABLE public.user_nutrition_training DROP CONSTRAINT fk_user_nutrition_training_nutrition_id');
        $this->addSql('ALTER TABLE public.user_nutrition_training DROP CONSTRAINT fk_user_nutrition_training_user_id');
        $this->addSql('DROP SEQUENCE public.user_nutrition_training_id_seq CASCADE');
        $this->addSql('DROP TABLE public.user_nutrition_training');
    }
}
