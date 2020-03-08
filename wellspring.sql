CREATE DATABASE IF NOT EXISTS website;

USE website;

CREATE TABLE trains(
  train_line VARCHAR(25) NOT NULL, 
  route_name VARCHAR(25) NOT NULL, 
  run_number VARCHAR(5) NOT NULL,  
  operator_id VARCHAR(25) NOT NULL,  
  PRIMARY KEY(run_number)
);