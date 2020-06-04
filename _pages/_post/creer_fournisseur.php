<?php
/**
 * Created by PhpStorm.
 * User: adewynter
 * Date: 19/02/2019
 * Time: 16:22
 */
include("../../_cfg/cfg.php");

$name=$_POST['name'];
$physical_address=$_POST['physical_address'];

if($_POST["invoice_address"] == NULL)
{
    $invoice_address=$_POST['physical_address'];
}
else{
    $invoice_address=$_POST['invoice_address'];
}

$is_active =1;

$array = array(
    'name' => $name,
    'physicalAddress' => $physical_address,
    'invoiceAddress' => $invoice_address,
    'isActive' => $is_active
);

$row = $_POST["row"];
$maxrow = $_POST["maxrow"];

$supplier = new Suppliers($array);
$suppliermanager = new SuppliersManager($bdd);




$test = $suppliermanager->add($supplier, $_POST["case"],$_POST["account"],$_POST["subaccount"]);

print_r($test);

if(!is_null($test))
{
    if($row < $maxrow) {
        $row++;
        //on ajoute 1 à la limite pour lire la prochaine ligne
        header('Location: http://test.bitwin.nc/backup_suppliers.php?row='.$row);
    }
    else{
        header('Location: http://test.bitwin.nc/index.php');
    }
}

?>
