Ninja-Squid-Reports
===================

MySQL Squid Log Analyzer

This Squid Log Analyzer takes both the squid access.log and the squidguard.log logs and parses them into a MySQL database
which is then used to create reports via a web front end.
The requirement for a tool like this was in great demand in my enviroment and although the insperation for this code 
came from both a mysar and SquidLight, it was coded by myself taking examples from the above mentioned projects.

Included in the repo files is the following files:

logparser.php - for parsing the logs and adding into the database loosely based on the log importer from mysar. 
                put this file anywhere on your system wiht your squid logs and schedule them to run via crontab.
db/ninjasquid.sql - for creating the database structure on your MySQL server

the main web files - the main web frontend files, place them in your htdocs folder.

This app requires the PHP-GD2 extension to be installed and enabled for the graphs in the monthly reports to work.
Before running the parser you eed to edit the pasrer file and tell it where to find your log files and the details
of your MySQL server and database.

/ Config section - Edit to your enviroment
// Log file locations:
$squidlog = "var/log/squidaccess.log";
$blocklog = "/var/log/squidguard/block.log";

// MySQL connection details
$server = "localhost";
$user = 'root';
$pass = '';
$database = 'ninjasquid';

the database settings for the web frontend is located in the inc/nsr.inc file.

Feel free to use and perhaps contribue to this project.
