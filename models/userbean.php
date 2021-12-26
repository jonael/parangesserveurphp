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
        private $voluntary = [];
        private $idTown;
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

        //méthode ajout d'un utilisateur en bdd
        public function createUser($bdd)
        {   
            try
            {   
                //requête ajout d'un utilisateur
                $req = $bdd->prepare(
                    'INSERT INTO 
                        userbean(pseudo, password, mail)
                    VALUES (:pseudo, :password, :mail)'
                );
                //éxécution de la requête SQL
                $req->execute(array(
                'pseudo' => $this->pseudo,
                'password' => $this->password,
                'mail' => $this->mail,)
                );
                return true;
            }
            catch(Exception $e)
            {
            //affichage d'une exception en cas d’erreur
            die('Erreur : '.$e->getMessage());
            }        
        }
        
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
    }
?>