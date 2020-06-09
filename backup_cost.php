<?php
include '_cfg/cfg.php';
include '_cfg/fonctions.php';


if (isset($_GET["row"]))
{
    $row = $_GET["row"];
}
else
{
    $row=0;
}

$bd = new PDO('mysql:host=localhost;port=3306; dbname=stm_test_db;charset=utf8', 'testuser', 'U!nx837j');
$count = $bd->query('SELECT * FROM quotation ORDER BY quotationNumber ASC ');
$maxrow = $count->rowCount();
$reponse = $bd->query('SELECT * FROM quotation ORDER BY quotationNumber ASC  LIMIT '.$row.',1');
$donnees = $reponse->fetch();

$array = array();

$req = $bd->query('SELECT * FROM devis_achat WHERE numdevis='.$donnees["quotationNumber"]);
$val = $req->fetch();

echo $donnees["quotationNumber"].' '.$donnees["id"];
echo '<br />';

echo $val["fournisseur_1"]." ".$val["cout_1"];

if($val["cout_1"] == 0)
{
    echo "pas de cout";
    $row++;
    header('Location: http://test.bitwin.nc/backup_cost.php?row='.$row);
}


/*
$new2old = array(
    'á' => 'Ã¡',

    'À' => 'Ã€',
    'ä' => 'Ã¤',
    'Ä' => 'Ã„',
    'ã' => 'Ã£',
    'å' => 'Ã¥',
    'Å' => 'Ã…',
    'æ' => 'Ã¦',
    'Æ' => 'Ã†',
    'ç' => 'Ã§',
    'Ç' => 'Ã‡',
    'é' => 'Ã©',
    'É' => 'Ã‰',
    'è' => 'Ã¨',
    'È' => 'Ãˆ',
    'ê' => 'Ãª',
    'Ê' => 'ÃŠ',
    'ë' => 'Ã«',
    'Ë' => 'Ã‹',
    'í' => 'Ã-­­',
    'Í' => 'Ã',
    'ì' => 'Ã¬',
    'Ì' => 'ÃŒ',
    'î' => 'Ã®',
    'Î' => 'ÃŽ',
    'ï' => 'Ã¯',
    'Ï' => 'Ã',
    'ñ' => 'Ã±',
    'Ñ' => 'Ã‘',
    'ó' => 'Ã³',
    'Ó' => 'Ã“',
    'ò' => 'Ã²',
    'Ò' => 'Ã’',
    'ô' => 'Ã´',
    'Ô' => 'Ã”',
    'ö' => 'Ã¶',
    'Ö' => 'Ã–',
    'õ' => 'Ãµ',
    'Õ' => 'Ã•',
    'ø' => 'Ã¸',
    'Ø' => 'Ã˜',
    'œ' => 'Å“',
    'Œ' => 'Å’',
    'ß' => 'ÃŸ',
    'ú' => 'Ãº',
    'Ú' => 'Ãš',
    'ù' => 'Ã¹',
    'Ù' => 'Ã™',
    'û' => 'Ã»',
    'Û' => 'Ã›',
    'ü' => 'Ã¼',
    'Ü' => 'Ãœ',
    '€' => 'â‚¬',
    '’' => 'â€™',
    '’' => 'Â€™',
    '‚' => 'â€š',
    'ƒ' => 'Æ’',
    '„' => 'â€ž',
    '…' => 'â€¦',
    '‡' => 'â€¡',
    'ˆ' => 'Ë†',
    '‰' => 'â€°',
    'Š' => 'Å ',
    '‹' => 'â€¹',
    'Ž' => 'Å½',
    '‘' => 'â€™',
    '“' => 'â€œ',
    '•' => 'â€¢',
    '–' => 'â€“',
    '—' => 'â€”',
    '˜' => 'Ëœ',
    '™' => 'â„¢',
    'š' => 'Å¡',
    '›' => 'â€º',
    'ž' => 'Å¾',
    'Ÿ' => 'Å¸',
    '¡' => 'Â¡',
    '¢' => 'Â¢',
    '£' => 'Â£',
    '¤' => 'Â¤',
    '¥' => 'Â¥',
    '¦' => 'Â¦',
    '§' => 'Â§',
    '¨' => 'Â¨',
    '©' => 'Â©',
    'ª' => 'Âª',
    '«' => 'Â«',
    '¬' => 'Â¬',
    '®' => 'Â®',
    '¯' => 'Â¯',
    '°' => 'Â°',
    '±' => 'Â±',
    '²' => 'Â²',
    '³' => 'Â³',
    '´' => 'Â´',
    'µ' => 'Âµ',
    '¶' => 'Â¶',
    '·' => 'Â·',
    '¸' => 'Â¸',
    '¹' => 'Â¹',
    'º' => 'Âº',
    '»' => 'Â»',
    '¼' => 'Â¼',
    '½' => 'Â½',
    '¾' => 'Â¾',
    '¿' => 'Â¿',
    'à' => 'Ã ',
    '†' => 'â€ ',
    '”' => 'â€',
    'Á' => 'Ã',
    'â' => 'Ã¢',
    'Â' => 'Ã‚',
    'Ã' => 'Ãƒ',

);

foreach( $new2old as $key => $value ) {
    $new[] = $key;
    $old[] = $value;
}

$data = array();
$supplier = new Suppliers($data);
$suppliermanager = new SuppliersManager($bdd);


?>
<div class="row">
    <div class="col-md-12">
        <?php if($retour == "error") { ?>
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button> Une erreur est survenue, le devis n'a donc pas pu être être mis à jour !</div>
        <?php } ?>
        <div class="portlet box blue-chambray">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fas fa-file-medical"></i>Récupération des coûts du devis <span style="font-weight: 800; font-style: italic;"><?php echo $donnees["quotationNumber"]; ?></span></div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?php echo URLHOST."_pages/_post/creer_cout_backup.php"; ?>" method="post" id="cost" name="cost" class="form-horizontal">
                    <div class="row" id="detaildevis">
                        <div class="col-md-12">
                            <div class="portlet box blue-dark">
                                <div class="portlet-body form" style="display: block;">
                                    <?php
                                    for($j = 1; $j <41; $j++){

                                        if($val["cout_".$j] != 0)
                                        {
                                            $val["description_".$j] = str_replace($old, $new, $val["description_".$j]);

                                            $val["fournisseur_".$j] = mb_strtoupper($val["fournisseur_".$j]);
                                            $supplier = $suppliermanager->getByName($val["fournisseur_".$j]);

                                            echo $val["fournisseur_".$j]." ".$val["description_".$j];

                                            //recherche du fournisseur dans la base actuelle

                                            if(empty($supplier))
                                            {
                                                $val["fournisseur_".$j] = str_replace("&#039;", "\'", $val["fournisseur_".$j]);
                                                $supplier = $suppliermanager->getByName($val["fournisseur_".$j]);
                                            }

                                            if(empty($supplier))
                                            {
                                                $val["fournisseur_".$j] = str_replace($old, $new, $val["fournisseur_".$j]);
                                                $supplier = $suppliermanager->getByName($val["fournisseur_".$j]);
                                            }

                                            if (empty($supplier))
                                            {
                                                $val["fournisseur_".$j] = str_replace( "\'", 'Â€™', $val["fournisseur_".$j] );
                                                $val["fournisseur_".$j] = str_replace( $old, $new, $val["fournisseur_".$j] );
                                                $data = array();
                                                $supplier = new Suppliers($data);
                                                $suppliermanager = new SuppliersManager($bdd);
                                                $supplier = $suppliermanager->getByName($val["fournisseur_".$j]);
                                            }
                                            if (empty($supplier))
                                            {
                                                $query = "INSERT INTO cost_issue (quotationNumber, supplier, description, cost) VALUES (".$donnees["quotationNumber"].",'".$val["fournisseur_".$j]."','".$val["description_".$j]."',".$val["cout_".$j].")";
                                                $bd->query($query);
                                                $row++;
                                                header('Location: http://test.bitwin.nc/backup_cost.php?row='.$row);
                                            }

                                            ?>
                                            <div id="ligneDevis<?php echo $j; ?>" class="ligneDevis" style="margin-left: 0px !important; margin-right: 0px !important;">
                                                <div class="col-md-12" style="display: flex; align-items: center;">

                                                    <div class="col-md-1">
                                                        <div class="form-group" style="margin-left: 0px !important; margin-right: 0px !important;">
                                                            <label class="control-label">Fournisseur</label>
                                                            <input type="digits" id="supplier<?php echo $j; ?>" name="supplier[<?php echo $j; ?>]" value="<?php echo $supplier->getIdSupplier();?>" class="form-control" placeholder="fournisseur">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="margin-left: 0px !important; margin-right: 0px !important;">
                                                            <label class="control-label">Description</label>
                                                            <textarea class="form-control" id="descriptionDevis<?php echo $j; ?>" name="descriptionDevis[<?php echo $j; ?>]" rows="4"><?php echo $val["description_".$j]; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group" style="margin-left: 0px !important; margin-right: 0px !important;">
                                                            <label class="control-label">Coût</label>
                                                            <input type="digits" id="value<?php echo $j; ?>" name="value[<?php echo $j; ?>]" value="<?php echo $val["cout_".$j]; ?>" class="form-control" placeholder="HT">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        else{
                                            $j = 41;
                                            break;
                                        }

                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="quotationNumber" value="<?php echo $donnees["quotationNumber"];?>" />
                        <input type="hidden" name="folderId" value="<?php echo $donnees["folderId"];?>" />
                        <input type="hidden" value="<?php echo $row; ?>" name="row" id="row" />
                        <input type="hidden" value="<?php echo $maxrow; ?>" name="maxrow" id="maxrow" />
                    </div>
                    <div class="form-actions fluid">
                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">
                                <button type="submit" class="btn green"><i class="fas fa-save"></i> Enregistrer</button>
                                <button type="button" class="btn default"><i class="fas fa-ban"></i> Annuler</button>
                            </div>
                        </div>
                    </div>

                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
            document.forms["cost"].submit();
        }

        function autoRefresh(){
            clearTimeout(auto);
            auto = setTimeout(function(){ submitform(); autoRefresh(); }, 1000);
        }
    }
</script>
