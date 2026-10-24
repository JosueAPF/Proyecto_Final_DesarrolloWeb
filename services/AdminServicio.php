<?php

    require_once __DIR__ . '/../repository/AdminRepository.php';
    class AdminServicio{
        
        private $repo;


        public function __construct(){
            $this->repo = new AdminReposirory();
        }

        public function monitor_resumen(){
            return $this->repo->monitor_resumen();  
        }

        public function monitor_montos(){
            return $this->repo->monitor_montos();
        }
    }

?>