<?php
require('import.php');
use XAWEB\SqlImport\Import;
$filename = 'database.sql';
$username = '';
$password = '';
$database = '';
$host = 'localhost';
new Import($filename, $username, $password, $database, $host);
