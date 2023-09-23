ALTER TABLE `ims_db`.`orders` 
ADD COLUMN `update_date` VARCHAR(45) NULL AFTER `online_amount`;

ALTER TABLE `ims_db`.`invoice` 
ADD COLUMN `update_date` VARCHAR(45) NULL AFTER `online_amount`;

ALTER TABLE `ims_db`.`invoice` 
ADD COLUMN `extra_gst` VARCHAR(45) NULL AFTER `update_date`,
ADD COLUMN `extra_gst_amount` VARCHAR(45) NULL AFTER `extra_gst`;


-- 30-05-2022

ALTER TABLE `ims_db_smtw`.`receipt` 
ADD COLUMN `payment_method` VARCHAR(145) NULL AFTER `description`;

ALTER TABLE `ims_db_smtw`.`inpurchase` 
ADD COLUMN `date_time` VARCHAR(245) NULL AFTER `discount`;

ALTER TABLE `ims_db_smtw`.`company` 
ADD COLUMN `email` VARCHAR(500) NULL AFTER `currency`;


