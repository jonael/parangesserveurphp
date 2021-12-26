<?php
    class Rolebean{
        private $idRole;
        private $roleName;

		public function getIdRole(){
			return $this->idRole;
		}
		public function setIdRole($idRole){
			$this->idRole = $idRole;
		}

		public function getRoleName(){
			return $this->roleName;
		}
		public function setRoleName($roleName){
			$this->roleName = $roleName;
		}

		public function getRoles($bdd, $idUser){
            $sqlQuery = 
                "SELECT 
                    *
                FROM
                    rolebean
                JOIN
					avoir
				WHERE
                    avoir.idUser = '".$idUser."'
				AND
					avoir.idRole = rolebean.idRole";

            $stmt = $bdd->prepare($sqlQuery);

            $stmt->execute();
            return $stmt;
        }
    }
?>