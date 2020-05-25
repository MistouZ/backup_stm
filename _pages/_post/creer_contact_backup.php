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
$customer = new Customers($data);
$customermanager = new CustomersManager($bdd);
$customer = $customermanager->getByName($_POST["customerName"]);

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
        if($contact2->getEmailAddress() != $contact->getEmailAddress() || $contact2->getPhoneNumber() != $contact->getPhoneNumber())
        {
            $contactmanager->duplicateContact($contact);
            $contactList = $contactmanager->getListAllToCustomer($customer->getIdCustomer());
        }

        if(!in_array($contact,$contactList))
        {
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
            if ($row < $maxrow) {
                $row++;
                header('Location: http://test.bitwin.nc/backup_contact.php?row=' . $row);
            } else {
                header('Location: http://test.bitwin.nc/index.php');
            }
        }
    }
    else {

        $data2 = array();
        $supplier = new Suppliers($data2);
        $suppliermanager = new SuppliersManager($bdd);
        $supplier = $suppliermanager->getByName($_POST["customerName"]);
        $test2 = $contactmanager->addToSuppliers($contact2, $supplier->getIdSupplier());
        if (!is_null($test2)) {
            if ($row < $maxrow) {
                $row++;
                header('Location: http://test.bitwin.nc/backup_contact.php?row='.$row);
            } else {
                header('Location: http://test.bitwin.nc/index.php');
            }
        } else {
            header('Location: http://test.bitwin.nc/index.php');
        }
    }
}
