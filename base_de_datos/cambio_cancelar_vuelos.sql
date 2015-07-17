ALTER TABLE `bookings` ADD `is_cancelled` BOOLEAN NOT NULL DEFAULT FALSE ;
ALTER TABLE `bookings` ADD `justification` VARCHAR(512) NOT NULL ;