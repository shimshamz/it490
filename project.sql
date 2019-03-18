create database stocks;
	
	use stocks;
	CREATE TABLE user 
		(
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY, fname varchar(100), lname varchar(60), age int, email varchar(60), password varchar(255), last_login TimeStamp DEFAULT current_timestamp ON UPDATE current_timestamp
		);

	create TABLE portfolio
		(
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY, userid int References user(id), Balance decimal(10,2) DEFAULT '5000', Profit_Loss decimal(10,2), last_login TimeStamp DEFAULT current_timestamp ON UPDATE current_timestamp  
		); 

	create TABLE company
		(
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY, portfolioid int References portfolio(id), comany_symbol char(25), company_name varchar(255), volume int, buy_date date, buy_amnt decimal(10,2)
		);
