<?php
    class Userbean{
        /*-----------------------------------------------------
                            Attributs :
        -----------------------------------------------------*/
        private $idUser;
        private $pseudo;
        private $password;
        private $mail;
        private $photoUrl;
        private $firstName;
        private $name;
        private $age;
        private $phone;
        private $since;
        private $shareInfos;
        private $voluntary = [];
        private $idTown;
        private $town;
        private $roles = [];
        
        /*-----------------------------------------------------
                            Getters and Setters :
        -----------------------------------------------------*/
        public function getIdUser(){
            return $this->idUser;
        }
        public function setIdUser($idUser){
            $this->idUser = $idUser;
        }
    
        public function getPseudo(){
            return $this->pseudo;
        }
        public function setPseudo($pseudo){
            $this->pseudo = $pseudo;
        }
    
        public function getPassword(){
            return $this->password;
        }
        public function setPassword($password){
            $this->password = $password;
        }
    
        public function getMail(){
            return $this->mail;
        }
        public function setMail($mail){
            $this->mail = $mail;
        }
    
        public function getPhotoUrl(){
            return $this->photoUrl;
        }
        public function setPhotoUrl($photoUrl){
            $this->photoUrl = $photoUrl;
        }
    
        public function getFirstName(){
            return $this->firstName;
        }
        public function setFirstName($firstName){
            $this->firstName = $firstName;
        }
    
        public function getName(){
            return $this->name;
        }
        public function setName($name){
            $this->name = $name;
        }
    
        public function getAge(){
            return $this->age;
        }
        public function setAge($age){
            $this->age = $age;
        }
    
        public function getPhone(){
            return $this->phone;
        }
        public function setPhone($phone){
            $this->phone = $phone;
        }
    
        public function getSince(){
            return $this->since;
        }
        public function setSince($since){
            $this->since = $since;
        }

        public function getShareInfos(){
            return $this->shareInfos;
        }
        public function setShareInfos($shareInfos){
            $this->shareInfos = $shareInfos;
        }
    
        public function getVoluntary(){
            return $this->voluntary;
        }
        public function setVoluntary($voluntary){
            $this->voluntary = $voluntary;
        }
    
        public function getIdTown(){
            return $this->idTown;
        }
        public function setIdTown($idTown){
            $this->idTown = $idTown;
        }

        public function getTown(){
            return $this->town;
        }
        public function setTown($town){
            $this->town = $town;
        }
    
        public function getRoles(){
            return $this->roles;
        }
        public function setRoles($roles){
            $this->roles = $roles;
        }
        /*-----------------------------------------------------
                            Méthodes :
        -----------------------------------------------------*/
        /*-----------------------------------------------------
                            Fonctions :
        -----------------------------------------------------*/

        
        // ajout Jonathan méthode qui retourne un utilisateur
        public function getSingleUser($bdd){
            $sqlQuery = 
                "SELECT 
                    *
                FROM
                    userbean
                WHERE 
                pseudo = '".$this->pseudo."'";

            $stmt = $bdd->prepare($sqlQuery);

            $stmt->execute();
            return $stmt;
        }

        public function verifyPseudoAndMail($bdd){
            $sqlQuery = 
                "SELECT 
                    *
                FROM
                    userbean
                WHERE 
                    pseudo = '".$this->pseudo."'
                OR 
                    mail = '".$this->mail."'";

            $stmt = $bdd->prepare($sqlQuery);

            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createUser($bdd){
            $password2 = password_hash($this->password, PASSWORD_BCRYPT);
            $date = new DateTime('NOW');
            $dateToStock = date_format($date, 'd-m-Y H:i:s');
            $sqlQuery = "INSERT INTO
                        userbean
                    SET
                        pseudo = :pseudo, 
                        password = :password, 
                        mail = :mail,
                        shareInfos = :shareInfos,
                        since = :since";

            $stmt = $bdd->prepare($sqlQuery);
        
            // bind data
            $stmt->bindParam(":pseudo", $this->pseudo);
            $stmt->bindParam(":password", $password2);
            $stmt->bindParam(":mail", $this->mail);
            $stmt->bindParam(":shareInfos", $this->shareInfos);
            $stmt->bindParam(":since", $dateToStock);

            $stmt->execute();
            return true;
        }

        // UPDATE
        public function updateUser(){
            $sqlQuery = 
                "UPDATE
                    ". $this->db_table ."
                SET
                    pseudo = :pseudo, 
                    password = :password, 
                    mail = :mail, 
                    idRoleSite = :idRoleSite, 
                    idRoleGame = :idRoleGame
                WHERE 
                    pseudo = :pseudo";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->pseudo=htmlspecialchars(strip_tags($this->pseudo));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->mail=htmlspecialchars(strip_tags($this->mail));
            $this->idRoleSite=htmlspecialchars(strip_tags($this->idRoleSite));
            $this->idRoleGame=htmlspecialchars(strip_tags($this->idRoleGame));
            $this->pseudo=htmlspecialchars(strip_tags($this->pseudo));
        
            // bind data
            $stmt->bindParam(":pseudo", $this->pseudo);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":mail", $this->mail);
            $stmt->bindParam(":idRoleSite", $this->idRoleSite);
            $stmt->bindParam(":idRoleGame", $this->idRoleGame);
            $stmt->bindParam(":pseudo", $this->pseudo);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function updateShareInfos($bdd, $idUser, $shareInfos){
            $sqlQuery = 
                "UPDATE
                    userbean
                SET
                    shareInfos = :shareInfos
                WHERE 
                    idUser = :idUser";
        
            $stmt = $bdd->prepare($sqlQuery);
        
            // bind data
            $stmt->bindParam(":shareInfos", $shareInfos);
            $stmt->bindParam(":idUser", $idUser);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        // DELETE
        function deleteUser(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE pseudo = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->pseudo=htmlspecialchars(strip_tags($this->pseudo));
        
            $stmt->bindParam(1, $this->pseudo);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function addRole($bdd, $idRole, $idUser){
            $sqlQuery = 
                "INSERT INTO 
                    avoir
                SET
                    idUser = :idUser, 
                    idRole = :idRole";

            $stmt = $bdd->prepare($sqlQuery);
        
            // bind data
            $stmt->bindParam(":idUser", $idUser);
            $stmt->bindParam(":idRole", $idRole);

            $stmt->execute();
            return true;
        }

        public function addNotifications($bdd, $idUser, $idNotification){
            $statut = 0;
            $sqlQuery = 
            "INSERT INTO 
                activer
            SET
                idUser = :idUser, 
                idNotification = :idNotification,
                statutNotification = :statutNotification";

            $stmt = $bdd->prepare($sqlQuery);
        
            // bind data
            $stmt->bindParam(":idUser", $idUser);
            $stmt->bindParam(":idNotification", $idNotification);
            $stmt->bindParam(":statutNotification", $statut);

            $stmt->execute();
            return true;
        }
    }
?>