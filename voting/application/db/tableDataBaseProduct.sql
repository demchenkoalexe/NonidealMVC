CREATE TABLE IF NOT EXISTS `questions` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(1000) NOT NULL COLLATE 'utf8_unicode_ci',
	`status` ENUM('1','0') NOT NULL DEFAULT '1' COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`id`)
) COLLATE='utf8_unicode_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `answers` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(500) NOT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`id`)
) COLLATE='utf8_unicode_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `question_answers` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`vote_count` INT(10) NOT NULL DEFAULT '0',
	`question_id` INT(10) UNSIGNED NOT NULL,
	`answer_id` INT(10) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `FK_question_answers_questions` (`question_id`),
	INDEX `FK_question_answers_answers` (`answer_id`),
	CONSTRAINT `FK_question_answers_answers` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`),
	CONSTRAINT `FK_question_answers_questions` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`)
) COLLATE='utf8_unicode_ci' ENGINE=InnoDB;
