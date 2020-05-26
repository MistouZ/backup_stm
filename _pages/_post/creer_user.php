<?php
/**
 * Created by PhpStorm.
 * User: adewynter
 * Date: 21/02/2019
 * Time: 11:29
 */

include("../../_cfg/cfg.php");

$row = $_POST["row"];
$maxrow = $_POST["maxrow"];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $phone = $_POST['phone_number'];
    $credential = $_POST["credential"];

    if (isset($_POST["is_seller"])) {
        $is_seller = 1;
    } else {
        $is_seller = 0;
    }
    $is_active = 1;
    
    $array = array(
        'username' => $username,
        'name' => $name,
        'firstname' => $firstname,
        'emailAddress' => $email,
        'password' => $password,
        'phoneNumber' => $phone,
        'credential' => $credential,
        'defaultCompany' => $_POST["societe"][0],
        'isSeller' => $is_seller,
        'isActive' => $is_active
    );

    $user = new Users($array);

    print_r($user);

    $usermanager = new UsersManager($bdd);
    $test = $usermanager->add($user, $_POST["societe"]);

if(!is_null($test)){
    if($row < $maxrow) {
        $row++;
        //on ajoute 1 à la limite pour lire la prochaine ligne
        header('Location: http://test.bitwin.nc/backup_users.php?row='.$row);
    }
    else{
        header('Location: http://test.bitwin.nc/index.php');
    }
}
?>