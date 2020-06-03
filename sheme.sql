CREATE TABLE `subjects` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`id`)
);

INSERT INTO `subjects` (`name`) VALUES
('Бизнес'), 
('Технологии'), 
('Реклама и Маркетинг');

CREATE TABLE `payments` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`id`)
);

INSERT INTO `payments` (`name`) VALUES
('WebMoney'),
('Яндекс.Деньги'),
('PayPal'),
('Кредитная карта');

CREATE TABLE `participants` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip` varchar(25) not null,
  `firstname` VARCHAR(255) NOT NULL,
  `lastname` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `subject_id` INT(10) NOT NULL,
  `payment_id` INT(10) NOT NULL,
  `mailing` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,

  PRIMARY KEY(`id`),
  INDEX `subject_id` (`subject_id`),
  INDEX `payment_id` (`payment_id`),
  INDEX `deleted_at` (`deleted_at`)
);