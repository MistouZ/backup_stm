<?php
/**
 * Created by PhpStorm.
 * User: adewynter
 * Date: 20/02/2019
 * Time: 13:38
 */

include("../../_cfg/cfg.php");


if($_POST["contact-select"] != 0) {
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

    if($_POST["isActive"] == "E")
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

    $folder = new Folder($array);
    $foldermanager = new FoldersManager($bdd);
    $test = $foldermanager->addBackup($folder);

    if (!is_null($test)) {
           header('Location: http://test.bitwin.nc/backup_quotation.php?row=' . $row);

    } else {
         header('Location: http://test.bitwin.nc/index.php');
    }

}
else{
    $label = $_POST["label"];
    $description = $_POST["description"];
    $seller = $_POST["seller-select"];
    $year = $_POST["year"];
    $month = $_POST["month"];
    $day = $_POST["day"];
    $companyId = $_POST["idcompany"];
    $FolderNumber = $_POST["folderNumber"];
    $customerId = $_POST["customerId"];

    if($_POST["isActive"] == "E")
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
    );

    $row = $_POST["row"];

    $folder = new Folder($array);
    $foldermanager = new FoldersManager($bdd);
    $test = $foldermanager->addBackupNoContact($folder);

        if (!is_null($test)) {
                header('Location: http://test.bitwin.nc/backup_quotation.php?row=' . $row);
        } else {
            header('Location: http://test.bitwin.nc/index.php');
        }
}