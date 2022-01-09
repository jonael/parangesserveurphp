<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include ('../models/notificationbean.php');
    include ('../config/connectBdd.php');

    $itemNotif = new Notificationbean();

    $stmt = $itemNotif->getALLNotifications($bdd);

    $notifs_arr = array();
    while($row = $stmt->fetch()) {
        extract($row);
        $notif = array(
            'idNotification' => intval($row['idNotification'],10),
            'notificationName' => $row['notificationName'],
        );
        array_push($notifs_arr, $notif);
    }
    http_response_code(200);
    echo json_encode($notifs_arr);
?>