<?php
    class Notificationbean {
        private $idNotification;
        private $notificationName;

        public function getIdNotification(){
            return $this->idNotification;
        }
        public function setIdNotification($idNotification){
            $this->idNotification = $idNotification;
        }
    
        public function getNotificationName(){
            return $this->notificationName;
        }
        public function setNotificationName($notificationName){
            $this->notificationName = $notificationName;
        }

        public function getNotifications($bdd, $idUser){
            $sqlQuery = 
                "SELECT 
                    *
                FROM
                    notificationbean
                JOIN
					activer
				WHERE
                    activer.idUser = '".$idUser."'
				AND
                    activer.statutNotification = 1
                AND
                    activer.idNotification = notificationbean.idNotification";

            $stmt = $bdd->prepare($sqlQuery);

            $stmt->execute();
            return $stmt;
        }
    }
?>