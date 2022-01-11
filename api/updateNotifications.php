<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include ('../config/connectBdd.php');
    include ('../utils/utilsFunctions.php');
    include ('../models/notificationbean.php');
    include ('../models/userbean.php');

    $data = json_decode(file_get_contents("php://input"));

    $sms = $data->sms;
    $mail = $data->mail;
    $call = $data->call;
    $notif = $data->notif;
    $idUser = $data->idUser;
    $share = $data->share;

    $itemsNotif = new Notificationbean();
    $itemUser = new Userbean();

    $stmt = $itemsNotif->getALLNotifications($bdd);

    $notifs_arr = array();
    $correct1 = false;
    $correct2 = false;
    $correct3 = false;
    $correct4 = false;
    $correct5 = false;
    while($row = $stmt->fetch()) {
        extract($row);
        if($row['idNotification'] == 1) {
            if(updateNotifications($bdd, $idUser, $row['idNotification'], $sms)){
                $correct1 = true;
            } else {
                $correct1 = false;
            }
        }
        if($row['idNotification'] == 2) {
            if(updateNotifications($bdd, $idUser, $row['idNotification'], $mail)) {
                $correct2 = true;
            } else {
                $correct2 = false;
            }
        }
        if($row['idNotification'] == 3) {
            if(updateNotifications($bdd, $idUser, $row['idNotification'], $call)) {
                $correct3 = true;
            } else {
                $correct3 = false;
            }
        }
        if($row['idNotification'] == 4) {
            if(updateNotifications($bdd, $idUser, $row['idNotification'], $notif)) {
                $correct4 = true;
            } else {
                $correct4 = false;
            }
        }
    }
    if($itemUser->updateShareInfos($bdd, $idUser, $share)) {
        $correct5 = true;
    } else {
        $correct = false;
    }
    if ($correct1 && $correct2 && $correct3 && $correct4 && $correct5) {
        http_response_code(200);
        echo json_encode(array('message' =>'vos paramètres ont été mis à jour avec succès'));
    } else {
        http_response_code(201);
        echo json_encode(array('message' =>'erreur lors de la mis à jour de vos paramètres, veuillez renouveler votre demande ultérieurement'));
    }
?>