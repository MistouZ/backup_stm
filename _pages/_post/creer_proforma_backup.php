<?php

/**
 * @author Amaury
 * @copyright 2019
 */

include("../../_cfg/cfg.php");

echo "Résultats : ";

$quotationNumber = $_POST["quotationNumber"];
$companyId = $_POST["idcompany"];
$folderId = $_POST["folder"];
$customerId = $_POST["customerId"];
$contactId = $_POST["contact-select"];
$label = $_POST["label"];
$year = $_POST["year"];
$month = $_POST["month"];
$day = $_POST["day"];
if(empty($_POST['comment'])){
    $comment = "";
}else{
    $comment = $_POST['comment'];
}


$status = "En cours";
$type = "P";


$data = array(
    'quotationNumber' => $quotationNumber,
    'status' => $status,
    'label' => $label,
    'year' => $year,
    'month' => $month,
    'day' => $day,
    'type' => $type,
    'comment' => $comment,
    'folderId' => $folderId,
    'companyId' => $companyId,
    'customerId' => $customerId,
    'contactId' => $contactId
);

$quotation = new Quotation($data);
$quotationmanager = new QuotationManager($bdd);

print_r($quotation);

$array = array();
$descriptionmanager = new DescriptionManager($bdd);

$quotationmanager->add($quotation);

//Ajout des lignes du devis
$descriptions= array();

$i=1;
while(($postDescription = current($_POST["descriptionDevis"])) !== FALSE ){

    $j = key($_POST["descriptionDevis"]);
    if(strlen(trim($postDescription))>0){
        if(empty($_POST["remiseDevis"][$j])){
            $remise = 0;
        }else{
            $remise = $_POST["remiseDevis"][$j];
        }
        if(empty($_POST["quantiteDevis"][$j])){
            $qt = 1;
        }else{
            $qt = $_POST["quantiteDevis"][$j];
        }
        $price = $_POST["prixDevis"][$j];
        $tax = $_POST["taxeDevis"][$j];
        $dataDescription= array(
            'description' => $postDescription,
            'quantity' => $qt,
            'discount' => $remise,
            'price' => $price,
            'tax' => $tax
        );

        $description = new Description($dataDescription);
        $descriptions[$i] = $description;
    }
    $i++;
    next($_POST["descriptionDevis"]);
}

$test = $descriptionmanager->add($descriptions,$quotationNumber);

$row = $_POST["row"];
$maxrow = $_POST["maxrow"];

if (!is_null($test)) {
    if ($row < $maxrow) {
        $row++;
        header('Location: http://test.bitwin.nc/backup_proformas.php?row='.$row);
    } else {
        header('Location: http://test.bitwin.nc/index.php');
    }
} else {
    //header('Location: http://test.bitwin.nc/index.php');
}
?>