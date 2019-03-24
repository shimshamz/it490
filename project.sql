create database stocks;
	
	use stocks;
	CREATE TABLE user 
		(
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY, fname varchar(100), lname varchar(60), email varchar(60), password varchar(255), balance decimal(10,2) DEFAULT '5000', ac_created TimeStamp DEFAULT current_timestamp
		);

	use stocks;
	create TABLE portfolio
		(
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY, user_id int References user(id), company_symbol char(25), company_name varchar(255), total_value decimal(10,2), total_volume int, last_buy_price decimal(10,2), last_buy_volume int, last_sell_price decimal(10,2), last_sell_volume int, last_updated TimeStamp DEFAULT current_timestamp ON UPDATE current_timestamp
		);

/* changed table names portfolio->dashboard and company->portfolio as it was getting a bit confusing
   added current_amnt in portfolio so each companies buying amount and and current amnt is clear
   added p/l in portfolio so net gain/loss can be seen of each company.
   Balance->balance
   removed age from user table
   added sell amnt and date in portfolio
   took out P_L from portfolio and dashboard