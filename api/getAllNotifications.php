<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
    
    include ('../models/notificationbean.php');
    include ('../config/connectBdd.php');

    $itemNotif = new Notificationbean();

    $data = json_decode(file_get_contents("php://input"));

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