drop schema if exists sys;
CREATE schema sys;
USE sys;
-- customer table tha stores, login information and assigns an id
CREATE TABLE USERS(
	USER_ID INT(5) NOT NULL, 
    FNAME VARCHAR(256) NOT NULL,    
    LNAME VARCHAR(256) NOT NULL,
	EMAIL VARCHAR(500) NOT NULL,
	USERNAME VARCHAR(500) NOT NULL,
	USER_PASSWORD VARCHAR(500) NOT NULL,
    BIRTH_DATE DATE NOT NULL, 
    PHONE_NUMBER VARCHAR(10),
    CONSTRAINT PK_CUS PRIMARY KEY (USER_ID)
);
-- customer account table that hold customer account number an refers to the previous table to aget the id of a cusotmer
CREATE table USER_Account(
	USER_ID INT(5) NOT NULL, 
    ACCOUNT_NUMBER INT(5) NOT NULL
);
-- purchase table stores the stocks purchased by the the customer
CREATE	table STOCKS(
	USER_ID INT(5) NOT NULL, 
	STOCK_DESCRIPTION varchar(500) NOT NULL 
    
);
CREATE table PORTFOLIO(
PORTFOLIO_No  VARCHAR(256),
USERNAME VARCHAR(256) NOT NULL,
STOCK_NAME VARCHAR(256)
);


ALTER TABLE USER_Account
	ADD CONSTRAINT FOREIGN KEY (USER_ID) REFERENCES USERS(USER_ID)
    ON UPDATE CASCADE;
    
    ALTER TABLE STOCKS
	ADD CONSTRAINT FOREIGN KEY (USER_ID) REFERENCES USERS(USER_ID)
    ON UPDATE CASCADE;

