<?php
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
$test = $suppliermanager->add($supplier, $_POST["case"], $_POST["account"],$_POST["subaccount"]);


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
else{
    $supplier2 = $suppliermanager->getByName($supplier->getName());
    $supplier2 = $suppliermanager->getByID($supplier2->getIdSupplier());


    $test2 = $suppliermanager->duplicate($supplier2, $_POST["case"][0]);

    if(!is_null($test2))
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
    else{
        echo "echec dans l'insertion de la duplication";
    }

}

?>
