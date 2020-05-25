<?php
/**
 * Created by PhpStorm.
 * User: adewynter
 * Date: 20/02/2019
 * Time: 13:38
 */

include("../../_cfg/cfg.php");


$name=$_POST['name'];
$firstname=$_POST['firstname'];
if(!empty($_POST['emailAddress'])){
    $emailAddress = $_POST['emailAddress'];
}else{
    $emailAddress = "";
}
if(!empty($_POST['phoneNumber'])){
    $phoneNumber = $_POST['phoneNumber'];
}else{
    $phoneNumber = "";
}

$is_active =1;

$array = array(
    'name' => $name,
    'firstname' => $firstname,
    'emailAddress' => $emailAddress,
    'phoneNumber' => $phoneNumber,
    'isActive' => $is_active
);

$row = $_POST["row"];
$maxrow = $_POST["maxrow"];

$contact = new Contact($array);
$contactmanager = new ContactManager($bdd);
$contact2 = $contactmanager->getByName($contact->getName(),$contact->getFirstname());

$data = array();
$contact_check = new Contact($data);
$customer = new Customers($data);
$customermanager = new CustomersManager($bdd);
$customer = $customermanager->getByName($_POST["customerName"]);

print_r($customer);

if(is_null($customer)) {
    if ($row < $maxrow) {
        $row++;
        header('Location: http://test.bitwin.nc/backup_contact.php?row=' . $row);
    }
    else {
        header('Location: http://test.bitwin.nc/index.php');
    }
}
else {
    $contactList = $contactmanager->getListAllToCustomer($customer->getIdCustomer());
    if ($contact2->getIdContact() == 0) {
        if ($row < $maxrow) {
            $row++;
            $contactmanager->addToCustomers($contact, $customer->getIdCustomer());
            header('Location: http://test.bitwin.nc/backup_contact.php?row=' . $row);
        } else {
            header('Location: http://test.bitwin.nc/index.php');
        }
    }
    elseif ($contact2->getName() != "Contact" && $contact2->getFirstname() != "Supprimé") {
        $contact->setIdContact($contact2->getIdContact());
        if(!in_array($contact,$contactList))
        {
            echo "je suis ici";
            print_r($contactList);
            $test = $contactmanager->addToCustomers($contact, $customer->getIdCustomer());
            if (!is_null($test)) {
                if ($row < $maxrow) {
                    $row++;
                    header('Location: http://test.bitwin.nc/backup_contact.php?row=' . $row);
                } else {
                    header('Location: http://test.bitwin.nc/index.php');
                }

            }
        }
        else {
            echo "je suis là";
            if ($row < $maxrow) {
                $row++;
                header('Location: http://test.bitwin.nc/backup_contact.php?row=' . $row);
            } else {
                header('Location: http://test.bitwin.nc/index.php');
            }
        }
    }
}
