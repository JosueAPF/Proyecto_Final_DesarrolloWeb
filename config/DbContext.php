<?php
class DbContext
{
    private $dbHost;
    private $dbUser;
    private $dbPass;
    private $dbName;

    private $charset;

    public function __construct()
    {
        $env = parse_ini_file(__DIR__ . "/../.env");
        $this->dbHost = $env["DB_HOST"];
        $this->dbUser = $env["DB_USER"];
        $this->dbPass = $env["DB_PASS"];
        $this->dbName = $env["DB_NAME"];
        $this->charset = $env["DB_CHARSER"];

    }
    public function getConnection()
    {
        try {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $mysqli = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
            $mysqli->set_charset($this->charset);

            return $mysqli;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}


?>