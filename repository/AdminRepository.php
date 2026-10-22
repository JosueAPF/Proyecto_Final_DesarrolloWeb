<?php
require_once __DIR__ . '/../config/DbContext.php';
class AdminReposirory
{
    private $dbConn;

    public function __construct()
    {
        $this->dbConn = new DbContext();
    }
}


?>