
<?php
/**
 * Configuration for database connection
 *
 */
$host       = "muhousing.cbc515bkgjyv.us-east-1.rds.amazonaws.com";
$username   = "bryangroves95";
$password   = "mypassword";
$dbname     = "muhousing";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
