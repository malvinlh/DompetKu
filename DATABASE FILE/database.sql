SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+07:00";

CREATE TABLE expense (
  expense_id int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id varchar(15) NOT NULL,
  expense int(20) NOT NULL,
  expensedate varchar(15) NOT NULL,
  expensecategory varchar(50) NOT NULL
);

CREATE TABLE users (
  user_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  firstname varchar(50) NOT NULL,
  lastname varchar(25) NOT NULL,
  email varchar(50) NOT NULL,
  profile_path varchar(50) NOT NULL DEFAULT 'default_profile.png',
  password varchar(50) NOT NULL,
  created_date datetime NOT NULL
);

CREATE TABLE income (
  income_id int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id varchar(15) NOT NULL,
  income int(20) NOT NULL,
  incomedate varchar(15) NOT NULL,
  incomecategory varchar(50) NOT NULL
);