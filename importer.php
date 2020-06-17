<?php 
namespace XAWEB\SqlImport;
use PDO;
use PDOException;
use Exception;
use Error;
class Import
{
    private $db;
    private $filename;
    private $username;
    private $password;
    private $database;
    private $host;
    public function __construct($filename, $username, $password, $database, $host)
    {
        $this->filename = $filename;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->host = $host;
        $this->connect();
        $this->openfile();
    }
    private function connect() {
        try {
            $this->db = new PDO("mysql:host=".$this->host.";dbname=".$this->database, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Cannot connect: ".$e->getMessage()."\n";
        }
    }
    private function query($query)
    {
        try {
            return $this->db->query($query);
        } catch(Error $e) {
            echo "Error with query: ".$e->getMessage()."\n";
        }
    }
    private function openfile()
    {
        try {
            if (!file_exists($this->filename)) {
                throw new Exception("Error: File not found.\n");
            }
            $fp = fopen($this->filename, 'r');
            $templine = '';
            while (($line = fgets($fp)) !== false) {
            	if (substr($line, 0, 2) == '--' || $line == '') {
            		continue;
                }
            	$templine .= $line;
            	if (substr(trim($line), -1, 1) == ';') {
                    $this->query($templine);
            		$templine = '';
            	}
            }
            fclose($fp);
        } catch(Exception $e) {
            echo "Error importing: ".$e->getMessage()."\n";
        }
    }
}
