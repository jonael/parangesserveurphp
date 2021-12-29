<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include ('../models/userbean.php');
    include ('../models/townbean.php');
    include ('../models/rolebean.php');
    include ('../models/notificationbean.php');
    include ('../config/connectBdd.php');

    $item = new Userbean();
    $itemTown = new Townbean();
    $itemRole = new Rolebean();
    $itemNotif = new Notificationbean();

    $data = json_decode(file_get_contents("php://input"));
    
    $item->setPseudo($data->pseudo);
    $item->setPassword($data->password);

    $stmt = $item->getSingleUser($bdd);
    $itemCount = $stmt->rowCount();

    if($itemCount == 0) {
        http_response_code(202);
        echo json_encode(array('message' => "Pas d'utilisateur trouvé."));
    } else {
        $user_arr = array();
        while($row = $stmt->fetch()) {
            extract($row);
            //if ($item->getPassword() === $row['password']) {
            if(password_verify($item->getPassword(), $row['password'])){
                $town_arr = array();
                $itemTown->setIdTown($row['idTown']);
                $town = $itemTown->getSingleTown($bdd);
                while($row2 = $town->fetch()) {
                    extract($row2);
                    $town_arr = array(
                        "idTown" =>  intval($row2['idTown'], 10),
                        "townName" => $row2['townName'],
                        "townCp" => $row2['townCp']
                    );
                }
                $role_arr = array();
                $roles = $itemRole->getRoles($bdd, $row['idUser']);
                while($row3 = $roles->fetch()) {
                    extract($row3);
                    $role = array(
                        "idRole" =>  intval($row3['idRole'], 10),
                        "roleName" => $row3['roleName'],
                    );
                    array_push($role_arr, $role);
                }
                $notif_arr = array();
                $notifications = $itemNotif->getNotifications($bdd, $row['idUser']);
                while($row4 = $notifications->fetch()) {
                    extract($row4);
                    $notif = array(
                        "idNotification" =>  intval($row4['idNotification'], 10),
                        "notificationName" => $row4['notificationName'],
                    );
                    array_push($notif_arr, $notif);
                }
                $user_item = array(
                    'idUser' => intval($row['idUser'], 10),
                    'pseudo' => $row['pseudo'],
                    'mail' => $row['mail'],
                    'photoUrl' => $row['photoUrl'],
                    'firstName' => $row['firstName'],
                    'name' => $row['name'],
                    'age' => intval($row['age'], 10),
                    'phone' => $row['phone'],
                    'since' => $row['since'],
                    'shareInfos' => intval($row['shareInfos'], 10),
                    'town' => $town_arr,
                    'roles' => $role_arr,
                    'voluntary' => $notif_arr,
                );
                array_push($user_arr, $user_item);
                http_response_code(200);
                echo json_encode($user_arr);
            } else {
                http_response_code(201);
                echo json_encode(array('message' =>'mot de passe incorrect'));
            }
        }
    }
?>