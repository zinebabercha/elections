DROP DATABASE IF EXISTS politico;
CREATE DATABASE politico;

-- Create the "users" table to store user information
CREATE TABLE if not exists users (
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  upassword VARCHAR(250) NOT NULL,
  email VARCHAR(100) NOT NULL,
  is_admin BOOLEAN DEFAULT FALSE
  --statut ENUM('voter', 'candidate')
);

-- Create the "offices" table to store office information
/*CREATE TABLE if not exists offices (
  office_id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(100) NOT NULL,
  office_description TEXT
);*/

-- Create the "candidates" table to store candidate information
CREATE TABLE if not exists candidates (
  candidate_id INT PRIMARY KEY ,
  candidate_name VARCHAR(100) NOT NULL,
  candidate_photo VARCHAR(100),
  election_id INT,
  FOREIGN KEY (election_id) REFERENCES elections(election_id)
);

-- Create the "elections" table to store election information
CREATE TABLE if not exists elections (
  election_id INT PRIMARY KEY ,
  title VARCHAR(100) NOT NULL,
  election_description TEXT,
  election_start_date DATETIME NOT NULL,
  end_date DATETIME NOT NULL
);

-- Create the "ballots" table to store ballot information
/*CREATE TABLE if not exists ballots (
  ballot_id INT PRIMARY KEY AUTO_INCREMENT,
  election_id INT,
  office_id INT,
  FOREIGN KEY (election_id) REFERENCES elections(election_id),
  FOREIGN KEY (office_id) REFERENCES offices(office_id)
);*/

-- Create the "votes" table to store user votes
CREATE TABLE if not exists votes (
  vote_id INT PRIMARY KEY ,
  user_id INT,
  election_id INT,
  encypted_vote VARCHAR(250),
  vote_timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (election_id) REFERENCES elections(election_id)
);

CREATE TABLE if not exists programs (
  program_id INT PRIMARY KEY ,
  candidate_id INT,
  program_title VARCHAR(100) NOT NULL,
  program_description TEXT,
  program_video VARCHAR(100),
  program_affiche VARCHAR(100),
  FOREIGN KEY (candidate_id) REFERENCES candidates(candidate_id));

-- Create the "candidate_votes" table to store vote count per candidate
/*CREATE TABLE if not exists candidate_votes (
  candidate_votes_id INT PRIMARY KEY AUTO_INCREMENT,
  candidate_id INT,
  ballot_id INT,
  vote_count INT,
  FOREIGN KEY (candidate_id) REFERENCES candidates(candidate_id),
  FOREIGN KEY (ballot_id) REFERENCES ballots(ballot_id)
);

-- Create the "election_results" table to store overall election results
CREATE TABLE if not exists election_results (
  election_results_id INT PRIMARY KEY AUTO_INCREMENT,
  election_id INT,
  total_votes INT,
  FOREIGN KEY (election_id) REFERENCES elections(election_id)
);*/

DELIMITER $$
CREATE TRIGGER email_format_users
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
  IF NEW.email NOT LIKE '%_@_%.%' THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid email format';
  END IF;
END$$
DELIMITER ;

/*INSERT INTO users (username, upassword, email, statut) VALUES
('jane', '$2y$10$BDkMViiukbiZiQDvGyh4OOSVvTMFRj.xW1n1yFulB/fCFmr8C4rRi', 'jane@example.com', 'candidate');
INSERT INTO users (username, upassword, email, statut) VALUES
('doe', '$2y$10$33v/PPP0Xam6S76eJPf8hOTOZ1UxztXuzR1i8.2FZmORQAgGCR2UG', 'doe$gmail.com', 'candidate');
INSERT INTO users (username, upassword, email, statut) VALUES
('jana', '$2y$10$3L2QojJg7ThzEfEXKP4EFO8DL0OpDI.3iaDd1i8QvmAGA7jTQ2WXm', 'jana@gmail.com', 'candidate');
INSERT INTO users(username, upassword, email, statut) VALUES
('smith', '$2y$10$dlCj4VddI6jP4efkO0Dr7OYQiv6eprdplfnCu8VKVwhBCzAyIuE82', 'smith@gmail.com', 'candidate');*/

/*INSERT INTO offices (title, office_description) VALUES
('President', 'The highest office in the country'),
('Governor', 'The head of the state government'),
('Council', 'The most known office in the country'),
('Director', 'The richest office in the country');

INSERT INTO candidates (candidate_name, party, office_id) VALUES
('jane', 'Independent', 1),
('doe', 'Democratic Party', 2),
('jana', 'Democratic Party', 3),
('smith', 'Independant', 4);


INSERT INTO elections (title, election_description, election_start_date, end_date) VALUES
('Presidential Election', 'Election for the President of the country', '2023-11-01', '2023-11-30'),
('State Governor Election', 'Election for the State Governor', '2023-10-15', '2023-11-15');


INSERT INTO ballots (election_id, office_id) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4);

INSERT INTO votes (user_id, candidate_id, ballot_id) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4);
*/

INSERT INTO programs ( program_id,program_title,candidate_id, program_description, program_video, program_affiche)
VALUES ( 1,'Program1',1, 'Description of the campaign1 program1', 'campaign1_video1.mp4', 'campaign2_affiche1.jpg');

INSERT INTO programs ( program_id,program_title,candidate_id, program_description, program_video, program_affiche)
VALUES ( 2,'Program2',2, 'Description of the campaign2 program2', 'campaign2_video2.mp4', 'campaign2_affiche2.jpg');


INSERT INTO programs (program_id, program_title,candidate_id, program_description, program_video, program_affiche)
VALUES ( 3,'Program3',3, 'Description of the campaign3 program3', 'campaign3_video3.mp4', 'campaign3_affiche3.jpg');

INSERT INTO programs ( program_id,program_title,candidate_id, program_description, program_video, program_affiche)
VALUES (4, 'Program4',4, 'Description of the campaign4 program4', 'campaign4_video4.mp4', 'campaign4_affiche4.jpg');


INSERT INTO elections (election_id,title, election_description, election_start_date, end_date)
VALUES (1,'Presidential Election', 'Description of the presidential election', '2023-06-01', '2023-06-30');

INSERT INTO elections (election_id,title, election_description, election_start_date, end_date)
VALUES (2,'State Governor Election', 'Description of the state governor election', '2023-06-01', '2023-06-30');

INSERT INTO elections (election_id,title, election_description, election_start_date, end_date)
VALUES (3,'Council Election', 'Description of the council election', '2023-06-01', '2023-06-30');

INSERT INTO elections (election_id,title, election_description, election_start_date, end_date)
VALUES (4,'Director Election', 'Description of the director election', '2023-06-01', '2023-06-30');


INSERT INTO candidates (candidate_id,candidate_name, candidate_photo, election_id)
VALUES (candidate_id,'John Doe', 'john_doe.jpg',1);

INSERT INTO candidates (candidate_id,candidate_name, candidate_photo, election_id)
VALUES ('Jane Smith', 'jane_smith.jpg',2);

INSERT INTO candidates (candidate_id,candidate_name, candidate_photo, election_id)
VALUES ('John Smith', 'john_smith.jpg',3);

INSERT INTO candidates (candidate_id,candidate_name, candidate_photo, election_id)
VALUES ('Jane Doe', 'jane_doe.jpg',4);

INSERT INTO votes (vote_id,user_ielection_id,encypted_vote ,vote_timestamp)
VALUES (1,1,1,'encrypted_vote1','2023-06-01 00:00:00');
VALUES (2,2,2,'encrypted_vote2','2023-06-01 00:00:00');
VALUES (3,3,3,'encrypted_vote3','2023-06-01 00:00:00');
VALUES (4,4,4,'encrypted_vote4','2023-06-01 00:00:00');


DROP DATABASE IF EXISTS politico;
CREATE DATABASE politico;

CREATE TABLE if not exists users (
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  upassword VARCHAR(250) NOT NULL,
  email VARCHAR(100) NOT NULL,
  is_admin BOOLEAN DEFAULT FALSE
);



CREATE TABLE if not exists candidates (
  candidate_id INT PRIMARY KEY ,
  candidate_name VARCHAR(100) NOT NULL,
  candidate_photo VARCHAR(100),
  election_id INT,
  FOREIGN KEY (election_id) REFERENCES elections(election_id)
);

CREATE TABLE if not exists elections (
  election_id INT PRIMARY KEY ,
  title VARCHAR(100) NOT NULL,
  election_description TEXT,
  election_start_date DATETIME NOT NULL,
  end_date DATETIME NOT NULL
);


CREATE TABLE if not exists votes (
  vote_id INT PRIMARY KEY ,
  user_id INT,
  election_id INT,
  encypted_vote VARCHAR(250),
  vote_timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (election_id) REFERENCES elections(election_id)
);

CREATE TABLE if not exists programs (
  program_id INT PRIMARY KEY ,
  candidate_id INT,
  program_title VARCHAR(100) NOT NULL,
  program_description TEXT,
  program_video VARCHAR(100),
  program_affiche VARCHAR(100),
  FOREIGN KEY (candidate_id) REFERENCES candidates(candidate_id));





DELIMITER $$
CREATE TRIGGER email_format_users
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
  IF NEW.email NOT LIKE '%_@_%.%' THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid email format';
  END IF;
END$$
DELIMITER ;