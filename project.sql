create database stocks;
	
	use stocks;
	CREATE TABLE user 
		(
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY, fname varchar(100), lname varchar(60), email varchar(60), password varchar(255), balance decimal(10,2) DEFAULT '5000', ac_created TimeStamp DEFAULT current_timestamp, UNIQUE (email)
		);

	use stocks;
	create TABLE portfolio
		(
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY, user_id int References user(id), company_symbol char(25), company_name varchar(255), total_value decimal(10,2), total_volume int, last_buy_price decimal(10,2), last_buy_volume int, last_sell_price decimal(10,2), last_sell_volume int, exchange char(25), last_updated TimeStamp DEFAULT current_timestamp ON UPDATE current_timestamp
		);

	use stocks;
	create TABLE deploy
		(
			bundle_name varchar(255), bundle_version varchar(10)
		);