create database stocks;
	
	use stocks;
	CREATE TABLE user 
		(
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY, fname varchar(100), lname varchar(60), email varchar(60), password varchar(255), ac_created TimeStamp DEFAULT current_timestamp
		);


	use stocks;
	create TABLE dashboard
		(
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY, userid int References user(id), balance decimal(10,2) DEFAULT '5000', Profit_Loss decimal(10,2), last_login TimeStamp DEFAULT current_timestamp ON UPDATE current_timestamp  
		); 


	use stocks;
	create TABLE portfolio
		(
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY, portfolioid int References dashboard(id), comany_symbol char(25), company_name varchar(255), volume int, buy_date date, buy_amnt decimal(10,2), current_amnt decimal(10,2), sell_date date, sell_amnt(10,2), P_L decimal (10,2)
		);

/* changed table names portfolio->dashboard and company->portfolio as it was getting a bit confusing
   added current_amnt in portfolio so each companies buying amount and and current amnt is clear
   added p/l in portfolio so net gain/loss can be seen of each company.
   Balance->balance
   removed age from user table
   added sell amnt and date in portfolio