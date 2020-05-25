<?php
include("../../_cfg/cfg.php");

	$name=$_POST['name'];
	$physical_address=$_POST['physical_address'];

	/*print_r($_POST);

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

    $customer = new Customers($array);
    $customermanager = new CustomersManager($bdd);

    $test = $customermanager->add($customer, $_POST["case"], $_POST["account"],$_POST["subaccount"], $_POST["taxes"]);
    echo "je suis passé ";
   //print_r($test);

/*
if(!is_null($test))
{
    if($row < $maxrow) {
        $row++;
        //on ajoute 1 à la limite pour lire la prochaine ligne
        header('Location: http://test.bitwin.nc/backup_customers.php?row='.$row);
    }
    else{
        header('Location: http://test.bitwin.nc/index.php');
    }
}/*
else{
    $customer2 = $customermanager->getByName($customer->getName());
    $customer2 = $customermanager->getByID($customer2->getIdCustomer());

    $test2 = $customermanager->duplicate($customer2, $_POST["case"][0]);

    if(!is_null($test2))
    {
        if($row < $maxrow) {
            $row++;
            //on ajoute 1 à la limite pour lire la prochaine ligne
            header('Location: http://test.bitwin.nc/backup_customers.php?row='.$row);
        }
        else{
            header('Location: http://test.bitwin.nc/index.php');
        }
    }
    else{
        echo "echec dans l'insertion de la duplication";
    }

}
*/
?>
