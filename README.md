# Educational Stock Market App

## Introduction
The project created by **Team Five** offers users an educational stock market app that helps users understand the concepts of stock market investment. The user can have a real-life portfolio simulating experience with our app that enables the user to invest in stocks with their fake money. Thus, learning the theory and practical knowledge of investing in the stock market.The app offers numerous other features including graphs to let the user visually interpret the data presented, portfolio evaluation/currency conversion, and current news articles based on the users portfolio.

### Languages and Technologies we used
* Front-end: HTML, CSS, Bootstrap, JavaScript and PHP
* Back-end: PHP
* Technologies: MySQL, RabbitMQ, Git

## Getting started
In order to use our app, you will need to download and install some software. Download and carefully follow the **readme.pdf** file for an in-depth walk-through of all that is required to make the app work properly.

Assuming that you have your VirtualBox VM up and running, with all the required packages installed, clone the master branch of this repository in */var/www/html/*: `git clone https://github.com/shimshamz/it490-development.git`

## To test
1. Make sure that the IP addresses in the **database.php** and **testRabbitMQ.ini** files are set to `127.0.0.1`.
2. In the terminal, run **testRabbitMQServer.php** to listen for user registration and login.
3. Open **index.html** in a browser to begin testing.
4. Register by filling out the neccessary fields.
5. Login using the email and password you registered with. 
6. If everything was installed and setup correctly, you should be greeted by a dashboard screen and a starting balance of $5,000.
7. Now, you are ready to start learning and investing. **Good Luck!**

## 3rd Party Data Source
Special thanks goes to Barchart for their API. For more information, visit their website [here](https://www.barchart.com/ondemand/api "Barchart API").

## Team Five Members
* Parthkumar Patel
* Shashwat Patel
* Jay Patel
* Parth Mehta
* Shameel Mohanlal