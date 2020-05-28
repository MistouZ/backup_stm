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
$count = $bd->query('SELECT * FROM proformas  WHERE societe !="nmcp" AND societe !="hydro" AND societe !="" AND etat = "E" GROUP BY num_pro ORDER BY num_pro ASC');
$maxrow = $count->rowCount();

$reponse = $bd->query('SELECT * FROM proformas  WHERE societe !="nmcp" AND societe !="hydro" AND societe !="" AND etat = "E" GROUP BY num_pro ORDER BY num_pro ASC LIMIT '.$row.',1');
$donnees = $reponse->fetch();

$array = array();

$req = $bd->query('SELECT * FROM dossier WHERE id='.$donnees["dossier"].' ');
$val = $req->fetch();

echo $donnees["num_pro"];
if(empty($val)){
    echo "pas de dossier";
    $row++;
    header('Location: http://test.bitwin.nc/backup_quotation.php?row=' .$row);
}
else{

    $array = array();

    echo $donnees["num_devis"];
    if ($donnees["societe"] == "agence")
    {
        $donnees["societe"] = "bitwin";
    }

    $company = new Company($array);
    $companymanager = new CompaniesManager($bdd);
    $folder = new Folder($array);
    $foldermanager = new FoldersManager($bdd);

    $company = $companymanager->getByNameData($donnees["societe"]);
    $idCompany = $company->getIdcompany();

    $folder = $foldermanager->getByNumFolder($val["num_doss"], $idCompany);


    if ($donnees["dossier"] == 0 || $val["etat"] == "A")
    {
        $row++;
        header('Location: http://test.bitwin.nc/backup_quotation.php?row='.$row);
    }

    $comments = str_replace ("<br />"," ",nl2br(utf8_decode($donnees["commentaire"])));

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

    if(empty($donnees["libelle"]))
    {
        $donnees["libelle"] = $folder->getLabel();
    }
    $donnees["libelle"] = str_replace($old, $new, $donnees["libelle"]);



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
                        <i class="fas fa-file-medical"></i>Modification du devis <span style="font-weight: 800; font-style: italic;"><?php echo $donnees["num_devis"]; ?></span></div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo URLHOST."_pages/_post/creer_devis_backup.php"; ?>" method="post" id="devis" name="devis" class="form-horizontal">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="customer-select">Client
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" id="customerId" name="customerId" value="<?php echo $folder->getCustomerId(); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="contact-select">Contact
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" data-required="1" class="form-control" name="contact-select" value="<?php echo $folder->getContactId();?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="contact-select">Dossier
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" data-required="1" class="form-control" name="folder" value="<?php echo $folder->getIdFolder();?>"/>
                                </div>
                            </div>

                            <div class="portlet-body form" style="display: block;">
                                <div class="row form-section" style="padding: 12px 20px 15px 20px; margin: 10px 0px 10px 0px !important;">
                                    <label class="col-md-2 control-label">Libellé du devis
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="libelle" name="label" class="form-control" placeholder="Libellé spécifique du devis" value="<?php echo $donnees["libelle"];?>">
                                        <span class="help-block">Si le libellé n'est pas rempli, le devis récupérera le libellé du dossier</span>
                                    </div>
                                </div>
                                <div class="row form-section" style="padding: 12px 20px 15px 20px; margin: 10px 0px 10px 0px !important;">
                                    <label class="col-md-2 control-label">Commentaire
                                    </label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Commentaire ..."><?php echo $comments; ?></textarea>
                                        <span class="help-block">Le commentaire s'affichera à la fin du devis</span>
                                    </div>
                                </div>


                                <div class="row" id="detaildevis">
                                    <div class="col-md-12">
                                        <div class="portlet box blue-dark">
                                            <div class="portlet-body form" style="display: block;">
                                                <?php
                                                $i = 1;

                                                for($j = 1; $j <25; $j++){
                                                    $donnees["descritption".$i] = str_replace($old, $new, $donnees["descritption".$i]);
                                                    ?>
                                                    <div id="ligneDevis<?php echo $i; ?>" class="ligneDevis" style="margin-left: 0px !important; margin-right: 0px !important;">
                                                        <div class="col-md-12" style="display: flex; align-items: center;">
                                                            <div class="col-md-6">
                                                                <div class="form-group" style="margin-left: 0px !important; margin-right: 0px !important;">
                                                                    <label class="control-label">Description</label>
                                                                    <textarea class="form-control" id="descriptionDevis<?php echo $i; ?>" name="descriptionDevis[<?php echo $i; ?>]" rows="4"><?php echo $donnees["descritption".$i]; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group" style="margin-left: 0px !important; margin-right: 0px !important;">
                                                                    <label class="control-label">Quantité</label>
                                                                    <input type="digits" id="quantiteDevis<?php echo $i; ?>" name="quantiteDevis[<?php echo $i; ?>]" value="<?php echo $donnees["quantite".$i]; ?>" class="form-control" placeholder="Qt.">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group" style="margin-left: 0px !important; margin-right: 0px !important;">
                                                                    <label class="control-label">Remise (%)</label>
                                                                    <input type="digits" id="remiseDevis<?php echo $i; ?>" name="remiseDevis[<?php echo $i; ?>]" value="<?php echo $donnees["remise".$i]; ?>" class="form-control" placeholder="xx">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group" style="margin-left: 0px !important; margin-right: 0px !important;">
                                                                    <label class="control-label">Taxes</label>
                                                                    <input type="digits" id="taxeDevis[<?php echo $i; ?>]" name="taxeDevis[<?php echo $i; ?>]" value="<?php echo $donnees["tss".$i]; ?>" class="form-control" placeholder="xx">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group" style="margin-left: 0px !important; margin-right: 0px !important;">
                                                                    <label class="control-label">Prix HT</label>
                                                                    <input type="digits" id="prixDevis<?php echo $i; ?>" name="prixDevis[<?php echo $i; ?>]" value="<?php echo $donnees["prix".$i]; ?>" class="form-control" placeholder="HT">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="hidden" name="idcompany" value="<?php echo $company->getIdcompany();?>" />
                                <input type="hidden" name="quotationNumber" value="<?php echo $donnees["num_devis"];?>" />
                                <input type="hidden" name="isActive" value="<?php echo $donnees["etat"];?>" />
                                <input type="hidden" name="date" value="<?php echo $donnees["annee"]."-".$donnees["mois"]."-".$donnees["jour"];?>" />
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
    <?php
}
?>
<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
            document.forms["devis"].submit();
        }

        function autoRefresh(){
            clearTimeout(auto);
            auto = setTimeout(function(){ submitform(); autoRefresh(); }, 1000);
        }
    }
</script>
