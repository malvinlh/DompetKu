SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+07:00";

CREATE TABLE users (
  user_id int(20) NOT NULL AUTO_INCREMENT,
  firstname varchar(50) NOT NULL,
  lastname varchar(25) NOT NULL,
  email varchar(50) NOT NULL,
  profile_path varchar(50) NOT NULL DEFAULT 'default_profile.png',
  password varchar(50) NOT NULL,
  created_date datetime NOT NULL,
  CONSTRAINT users_pk PRIMARY KEY (user_id)
);

CREATE TABLE expense (
  expense_id int(20) NOT NULL AUTO_INCREMENT,
  user_id int(20) NOT NULL,
  expense int(20) NOT NULL,
  expensedate varchar(15) NOT NULL,
  expensecategory varchar(50) NOT NULL,
  CONSTRAINT expense_pk PRIMARY KEY (expense_id)
);

CREATE TABLE income (
  income_id int(20) NOT NULL AUTO_INCREMENT,
  user_id int(20) NOT NULL,
  income int(20) NOT NULL,
  incomedate varchar(15) NOT NULL,
  incomecategory varchar(50) NOT NULL,
  CONSTRAINT income_pk PRIMARY KEY (income_id)
);

ALTER TABLE expense ADD CONSTRAINT fk_expense_users FOREIGN KEY fk_expense_users (user_id)
  REFERENCES users (user_id) ON DELETE CASCADE;

ALTER TABLE income ADD CONSTRAINT fk_income_users FOREIGN KEY fk_income_users (user_id)
  REFERENCES users (user_id) ON DELETE CASCADE;