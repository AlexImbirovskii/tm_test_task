<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240828102617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE answers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE options_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE questions_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE results_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE answers (id INT NOT NULL, result_id INT NOT NULL, question_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_50D0C6067A7B643 ON answers (result_id)');
        $this->addSql('CREATE INDEX IDX_50D0C6061E27F6BF ON answers (question_id)');
        $this->addSql('CREATE TABLE answers_options (answer_id INT NOT NULL, option_id INT NOT NULL, PRIMARY KEY(answer_id, option_id))');
        $this->addSql('CREATE INDEX IDX_E7F26B28AA334807 ON answers_options (answer_id)');
        $this->addSql('CREATE INDEX IDX_E7F26B28A7C41D6F ON answers_options (option_id)');
        $this->addSql('CREATE TABLE options (id INT NOT NULL, question_id INT NOT NULL, text VARCHAR(255) NOT NULL, is_correct BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D035FA871E27F6BF ON options (question_id)');
        $this->addSql('CREATE TABLE questions (id INT NOT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE questions_results (question_id INT NOT NULL, result_id INT NOT NULL, PRIMARY KEY(question_id, result_id))');
        $this->addSql('CREATE INDEX IDX_EC26C4D21E27F6BF ON questions_results (question_id)');
        $this->addSql('CREATE INDEX IDX_EC26C4D27A7B643 ON questions_results (result_id)');
        $this->addSql('CREATE TABLE results (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C6067A7B643 FOREIGN KEY (result_id) REFERENCES results (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C6061E27F6BF FOREIGN KEY (question_id) REFERENCES questions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answers_options ADD CONSTRAINT FK_E7F26B28AA334807 FOREIGN KEY (answer_id) REFERENCES answers (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answers_options ADD CONSTRAINT FK_E7F26B28A7C41D6F FOREIGN KEY (option_id) REFERENCES options (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE options ADD CONSTRAINT FK_D035FA871E27F6BF FOREIGN KEY (question_id) REFERENCES questions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE questions_results ADD CONSTRAINT FK_EC26C4D21E27F6BF FOREIGN KEY (question_id) REFERENCES questions (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE questions_results ADD CONSTRAINT FK_EC26C4D27A7B643 FOREIGN KEY (result_id) REFERENCES results (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE answers_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE options_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE questions_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE results_id_seq CASCADE');
        $this->addSql('ALTER TABLE answers DROP CONSTRAINT FK_50D0C6067A7B643');
        $this->addSql('ALTER TABLE answers DROP CONSTRAINT FK_50D0C6061E27F6BF');
        $this->addSql('ALTER TABLE answers_options DROP CONSTRAINT FK_E7F26B28AA334807');
        $this->addSql('ALTER TABLE answers_options DROP CONSTRAINT FK_E7F26B28A7C41D6F');
        $this->addSql('ALTER TABLE options DROP CONSTRAINT FK_D035FA871E27F6BF');
        $this->addSql('ALTER TABLE questions_results DROP CONSTRAINT FK_EC26C4D21E27F6BF');
        $this->addSql('ALTER TABLE questions_results DROP CONSTRAINT FK_EC26C4D27A7B643');
        $this->addSql('DROP TABLE answers');
        $this->addSql('DROP TABLE answers_options');
        $this->addSql('DROP TABLE options');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE questions_results');
        $this->addSql('DROP TABLE results');
    }
}
