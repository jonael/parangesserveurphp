<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include ('../models/userbean.php');
    include ('../models/rolebean.php');
    include ('../models/notificationbean.php');
    include ('../config/connectBdd.php');

    $item = new Userbean();

    $data = json_decode(file_get_contents("php://input"));

    $item->setPseudo($data->pseudo);
    $item->setPassword($data->password);
    $item->setMail($data->mail);
    $item->setShareInfos(0);
    $stmt = $item->verifyPseudoAndMail($bdd);
    $itemCount = $stmt->rowCount();
    $user_arr = array();

    if($itemCount > 0) {
        http_response_code(203);
        echo json_encode(array('message' => "LePseudo et/ou le mail sont déjà existants, veuillez vous connecter ou renouveler votre inscription avec d'autres identifiants"));
    } else {
        if($item->createUser($bdd)){
            $toReturn = $item->getSingleUser($bdd);
            $newItemCount = $toReturn->rowCount();
            if($newItemCount > 0) {
                while($row = $toReturn->fetch()) {
                    $userToReturn = new Userbean();
                    $itemRole = new Rolebean();
                    $town_arr = array();
                    $role_arr = array();
                    $item->addRole($bdd, 3, $row['idUser']);
                    $item_notif = new Notificationbean();
                    $table = $item_notif->getALLNotifications($bdd);
                    while($rowTable = $table->fetch()){
                        extract($rowTable);
                        $item->addNotifications($bdd, $row['idUser'], $rowTable['idNotification']);
                    }
                    $roles = $itemRole->getRoles($bdd, $row['idUser']);
                    while($row2 = $roles->fetch()) {
                        extract($row2);
                        $role = array(
                            "idRole" =>  intval($row2['idRole'], 10),
                            "roleName" => $row2['roleName'],
                        );
                        array_push($role_arr, $role);
                    }
                    $itemNotif = new Notificationbean();
                    $notif_arr = array();
                    $notifications = $itemNotif->getNotifications($bdd, $row['idUser']);
                    while($row3 = $notifications->fetch()) {
                        extract($row3);
                        $notif = array(
                            "idNotification" =>  intval($row3['idNotification'], 10),
                            "notificationName" => $row3['notificationName'],
                        );
                        array_push($notif_arr, $notif);
                    }
                    extract($row);
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
                        'town' => null,
                        'roles' => $role_arr,
                        'voluntary' => $notif_arr,
                    );
                    array_push($user_arr, $user_item);
                }
            // converti en json et renvoi
            http_response_code(200);
            echo json_encode($user_arr);
            } else {
                http_response_code(202);
                echo json_encode(array('message' => "Pas d'utilisateur trouvé."));
            }
        } else {
            http_response_code(404);
            echo json_encode(array("Erreur lors de l'ajout de l'utilisateur"));
        }
    }
?>