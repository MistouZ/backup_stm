<?php
/**
 * Created by PhpStorm.
 * User: adewynter
 * Date: 20/02/2019
 * Time: 13:38
 */

include("../../_cfg/cfg.php");


    $label = $_POST["label"];
    $description = $_POST["description"];
    $seller = $_POST["seller-select"];
    $year = $_POST["year"];
    $month = $_POST["month"];
    $day = $_POST["day"];
    $contactId = $_POST["contact-select"];
    $companyId = $_POST["idcompany"];
    $FolderNumber = $_POST["folderNumber"];
    $customerId = $_POST["customerId"];

    if($_POST["isActive"] == "E" || $_POST["isActive"] == 1)
    {
        $isActive = 1;
    }
    else{
        $isActive = 0;
    }

    $array = array(
        'FolderNumber' => $FolderNumber,
        'label' => $label,
        'year' => $year,
        'month' => $month,
        'day' => $day,
        'isActive' => $isActive,
        'description' => $description,
        'seller' => $seller,
        'companyId' => $companyId,
        'customerId' => $customerId,
        'contactId' => $contactId
    );


    $row = $_POST["row"];
    $maxrow = $_POST["maxrow"];

    $folder = new Folder($array);
    print_r($folder);
    $foldermanager = new FoldersManager($bdd);
    $test = $foldermanager->addBackup($folder);

    if (!is_null($test)) {
        if ($row < $maxrow) {
            $row++;
            header('Location: http://test.bitwin.nc/backup_folder.php?row=' . $row);
        } else {
            echo "plus de data";
            //header('Location: http://test.bitwin.nc/index.php');
        }
    } else {
        echo "problem";
       // header('Location: http://test.bitwin.nc/index.php');
    }
