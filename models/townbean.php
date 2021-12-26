<?php
    class Townbean {
        private $idTown;
        private $townName;
        private $townCp;

        public function getIdTown(){
            return $this->idTown;
        }
        public function setIdTown($idTown){
            $this->idTown = $idTown;
        }
    
        public function getTownName(){
            return $this->townName;
        }
        public function setTownName($townName){
            $this->townName = $townName;
        }
    
        public function getTownCp(){
            return $this->townCp;
        }
        public function setTownCp($townCp){
            $this->townCp = $townCp;
        }

        public function getSingleTown($bdd){
            $sqlQuery = 
                "SELECT 
                    *
                FROM
                    townbean
                WHERE 
                    idTown = '".$this->idTown."'";

            $stmt = $bdd->prepare($sqlQuery);

            $stmt->execute();
            return $stmt;
        }
    }
?>