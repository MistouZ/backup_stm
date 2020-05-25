<?php

/**
 * @author Amaury
 * @copyright 2019
 */

include("../../_cfg/cfg.php");

echo "Résultats : ";

$quotationNumber = $_POST["quotationNumber"];
$folderId = $_POST["folderId"];
$costmanager = new CostManager($bdd);

$i=1;
while(($postDescription = current($_POST["descriptionDevis"])) !== FALSE ){

    $j = key($_POST["descriptionDevis"]);
    if(strlen(trim($postDescription))>0){
        $price = $_POST["value"][$j];
        $supplier = $_POST["supplier"][$j];
        $dataDescriptionCout= array(
            'description' => $postDescription,
            'value' => $price,
            'folderId' => $folderId,
            'supplierId' => $supplier
        );

        $descriptionCout = new Cost($dataDescriptionCout);
        $descriptionsCout[$i] = $descriptionCout;
    }
    $i++;
    next($_POST["descriptionDevis"]);
}

print_r($descriptionCout);
echo $quotationNumber;

$test = $costmanager->add($descriptionsCout,$quotationNumber);

$row = $_POST["row"];
$maxrow = $_POST["maxrow"];

if (!is_null($test)) {
    if ($row < $maxrow) {
        $row++;
        header('Location: http://test.bitwin.nc/backup_cost.php?row='.$row);
    } else {
        header('Location: http://test.bitwin.nc/index.php');
    }
} else {
    if ($row < $maxrow) {
        $row++;
        header('Location: http://test.bitwin.nc/backup_cost.php?row='.$row);
    }
    else {
        header('Location: http://test.bitwin.nc/index.php');
    }
}
?>