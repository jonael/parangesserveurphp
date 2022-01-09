<?php
    function updateNotifications($bdd, $idUser, $idNotif, $statut){
        $sqlQuery = 
            "UPDATE 
                activer
            SET
                statutNotification = :statutNotification
            
            WHERE
                activer.idUser = :idUser
            AND
                activer.idNotification = :idNotif";

        $stmt = $bdd->prepare($sqlQuery);

        $stmt->bindParam(":statutNotification", $statut);
        $stmt->bindParam(":idUser", $idUser);
        $stmt->bindParam(":idNotif", $idNotif);

        return $stmt->execute();
    }
?>