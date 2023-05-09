CREATE TABLE `Users` (
	`userID` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`name` TEXT NOT NULL,
	`surname` TEXT NOT NULL,
	`roleID` INT NOT NULL,
	`expireDate` DATETIME NOT NULL,
	`password_hash` TEXT NOT NULL,
	`sessionToken` TEXT NOT NULL,
	`email` TEXT NOT NULL,
	`phone` INT NOT NULL,
	`locationID` int NOT NULL,
	`aboutMe` TEXT NOT NULL,
	PRIMARY KEY (`userID`)
);

CREATE TABLE `Events` (
	`eventID` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`title` TEXT NOT NULL,
	`description` TEXT NOT NULL,
	`photosJson` json NOT NULL,
	`maxSlots` INT NOT NULL,
	`dateTime` DATETIME NOT NULL,
	`difficultLevelID` INT NOT NULL,
	`locationID` INT NOT NULL,
	`categoryID` INT NOT NULL,
	`trainerID` INT NOT NULL,
	PRIMARY KEY (`eventID`)
);

CREATE TABLE `Categories` (
	`categoryID` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`name` TEXT NOT NULL,
	`description` TEXT,
	PRIMARY KEY (`categoryID`)
);

CREATE TABLE `Cities` (
	`locationID` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`name` TEXT NOT NULL,
	PRIMARY KEY (`locationID`)
);

CREATE TABLE `DifficultLevel` (
	`difficultLevelID` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`name` TEXT NOT NULL,
	PRIMARY KEY (`difficultLevelID`)
);

CREATE TABLE `Roles` (
	`roleID` INT NOT NULL AUTO_INCREMENT,
	`roleName` TEXT NOT NULL,
	PRIMARY KEY (`roleID`)
);

CREATE TABLE `Reservations` (
	`reservationID` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`eventID` INT NOT NULL,
	`userID` INT NOT NULL,
	`reservationDateTime` DATETIME NOT NULL,
	`completed` bool NOT NULL,
	PRIMARY KEY (`reservationID`)
);

CREATE TABLE `Conversations` (
	`conversationID` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`trainerID` INT NOT NULL,
	`userID` INT NOT NULL,
	`eventID` INT NOT NULL,
	PRIMARY KEY (`conversationID`)
);

CREATE TABLE `Messages` (
	`messageID` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`content` TEXT NOT NULL,
	`dateTime` INT NOT NULL,
	`conversationID` INT NOT NULL,
	PRIMARY KEY (`messageID`)
);

ALTER TABLE `Users` ADD CONSTRAINT `Users_fk0` FOREIGN KEY (`roleID`) REFERENCES `Roles`(`roleID`);

ALTER TABLE `Users` ADD CONSTRAINT `Users_fk1` FOREIGN KEY (`locationID`) REFERENCES `Cities`(`locationID`);

ALTER TABLE `Events` ADD CONSTRAINT `Events_fk0` FOREIGN KEY (`difficultLevelID`) REFERENCES `DifficultLevel`(`difficultLevelID`);

ALTER TABLE `Events` ADD CONSTRAINT `Events_fk1` FOREIGN KEY (`locationID`) REFERENCES `Cities`(`locationID`);

ALTER TABLE `Events` ADD CONSTRAINT `Events_fk2` FOREIGN KEY (`categoryID`) REFERENCES `Categories`(`categoryID`);

ALTER TABLE `Events` ADD CONSTRAINT `Events_fk3` FOREIGN KEY (`trainerID`) REFERENCES `Users`(`userID`);

ALTER TABLE `Reservations` ADD CONSTRAINT `Reservations_fk0` FOREIGN KEY (`eventID`) REFERENCES `Events`(`eventID`);

ALTER TABLE `Reservations` ADD CONSTRAINT `Reservations_fk1` FOREIGN KEY (`userID`) REFERENCES `Users`(`userID`);

ALTER TABLE `Conversations` ADD CONSTRAINT `Conversations_fk0` FOREIGN KEY (`trainerID`) REFERENCES `Users`(`userID`);

ALTER TABLE `Conversations` ADD CONSTRAINT `Conversations_fk1` FOREIGN KEY (`userID`) REFERENCES `Users`(`userID`);

ALTER TABLE `Conversations` ADD CONSTRAINT `Conversations_fk2` FOREIGN KEY (`eventID`) REFERENCES `Events`(`eventID`);

ALTER TABLE `Messages` ADD CONSTRAINT `Messages_fk0` FOREIGN KEY (`conversationID`) REFERENCES `Conversations`(`conversationID`);










