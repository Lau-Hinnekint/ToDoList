ALTER TABLE `status` CHANGE `ID_status` `ID_status` INT NOT NULL AUTO_INCREMENT; 

INSERT INTO status (status_name) VALUES ('A FAIRE');
INSERT INTO status (status_name) VALUES ('EN COURS');
INSERT INTO status (status_name) VALUES ('TERMINER');

UPDATE `task` SET `ID_status` = '2' WHERE `task`.`ID_task` = 1 ;
UPDATE `task` SET `ID_status` = '3' WHERE `task`.`ID_task` = 2 ;
UPDATE `task` SET `ID_status` = '1' WHERE `task`.`ID_task` = 3 ;
UPDATE `task` SET `ID_status` = '2' WHERE `task`.`ID_task` = 4 ;
UPDATE `task` SET `ID_status` = '1' WHERE `task`.`ID_task` = 5 ;
UPDATE `task` SET `ID_status` = '2' WHERE `task`.`ID_task` = 6 ;
UPDATE `task` SET `ID_status` = '3' WHERE `task`.`ID_task` = 7 ;
UPDATE `task` SET `ID_status` = '1' WHERE `task`.`ID_task` = 8 ;
UPDATE `task` SET `ID_status` = '3' WHERE `task`.`ID_task` = 9 ;
UPDATE `task` SET `ID_status` = '1' WHERE `task`.`ID_task` = 10 
