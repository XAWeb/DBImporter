<?php
require('import.php'); //SINIFI DAHİL ETTİK
use XAWEB\SqlImport\Import; //SINIFI ÇAĞIRDIK
$filename = 'database.sql'; // Import işlemini gerçekleştirmek istediğiniz veritabanının adını girin.
$username = ''; // Veritabanı kullanıcı adınız
$password = ''; // Veritabanı şifreniz
$database = ''; // Yüklemenin gerçekleşeceği veri tabanı
$host = 'localhost'; // İşlemin gerçekleştirileceği sunucu
new Import($filename, $username, $password, $database, $host);
