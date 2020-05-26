<?php

session_start();

include '_cfg/cfg.php';
include '_cfg/fonctions.php';

if (isset($_GET["row"]))
{
    $i = $_GET["row"];
}
else
{
    $i=0;
}

//récupération des données de l'utilisateur
$bd = new PDO('mysql:host=localhost;port=3306; dbname=stm_test_db;charset=utf8', 'testuser', 'U!nx837j');

$count = $bd->query('SELECT * FROM dossier WHERE societe="concept" OR societe ="concerto" OR societe="agence" OR societe = "itech" AND annee >= 2018 GROUP BY client');
$maxrow = $count->rowCount();

$req = $bd->query('SELECT * FROM dossier WHERE societe="concept" OR societe ="concerto" OR societe="agence" OR societe = "itech"  AND annee >= 2018 GROUP BY client LIMIT '.$i.',1 ');
$recup = $req->fetch();


$reponse = $bd->query('SELECT * FROM client WHERE concept="O" AND nom="'.$recup["client"].'" OR concerto="O" AND nom="'.$recup["client"].'" OR agence="O" AND nom="'.$recup["client"].'" OR itech="O" AND nom="'.$recup["client"].'"');
$donnees = $reponse->fetch();

$array = array();
$company = new Company($array);
$companymanager = new CompaniesManager($bd);
$companymanager = $companymanager->getList();
$tax = new Tax($array);
$taxes = new TaxManager($bd);
$taxes = $taxes->getList();


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
    'À' => 'Ã',
    'ì' => 'Ã¬',
    'Ì' => 'ÃŒ',
    'î' => 'Ã®',
    'Î' => 'ÃŽ',
    'Ï' => 'Ã¯',
    'Ï' => 'Ã',
    'ñ' => 'Ã±',
    'Ñ' => 'Ã‘',
    'ó' => 'Ã³',
    'Ó' => 'Ã“',
    'ò' => 'Ã²',
    'Ò' => 'Ã’',
    'Ô' => 'Ã´',
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
    //'’' => 'â€™',
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

//$donnees["nom"] = str_replace( $old, $new, $donnees["nom"] );
$donnees["nom"] = RemoveBS($donnees["nom"]);
//$donnees["nom"] = utf8_decode(mb_convert_encoding($donnees["nom"], "HTML-ENTITIES", 'UTF-8'));
echo $donnees["nom"];

$donnees["adphysique"] = utf8_decode($donnees["adphysique"]);
$donnees["adfactu"] = utf8_decode($donnees["adfactu"]);

$donnees["adphysique"] = str_replace ("<br />"," ",nl2br($donnees["adphysique"]));
$donnees["adfactu"] = str_replace ("<br />"," ",nl2br($donnees["adfactu"]));
//echo $donnees["societe"];

if($donnees["agence"] == "O"){
    $donnees["bitwin"] = "O";
    $donnees["sscompte_bitwin"] = $donnees["sscompte_agence"];
}


?>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings"></i>
                    <span class="caption-subject sbold uppercase">Création d'un client <?php echo $donnees["nom"]; ?></span>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?php echo URLHOST."_pages/_post/creer_client.php"; ?>" method="post" id="client" name="client" class="form-horizontal">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button> Une erreur s'est produite, merci de renseigner les champs requis. </div>
                        <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button> Le client a bien été créé </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nom du client
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fas"></i>
                                    <input type="text" data-required="1" class="form-control" name="name" value="<?php echo $donnees["nom"]; ?>" /> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Adresse physique
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fas"></i>
                                    <input type="text" data-required="1" class="form-control" name="physical_address" id="physical_address" value="<?php echo $donnees["adphysique"]; ?>" /> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Adresse de facturation
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <i class="fas"></i>
                                    <input type="text" data-required="1" class="form-control" name="invoice_address" id="invoice_address" value="<?php echo $donnees["adfactu"]; ?>" /> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Fournisseur
                            </label>
                            <div class="col-md-9">
                                <div class="checkbox-list">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="is_supplier" name="is_supplier" id="is_supplier" /></label>
                                </div>
                                <span class="help-block"> Cocher si ce client est aussi un fournisseur </span>
                                <div id="form_2_services_error"> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Société
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <div class="checkbox-list" data-error-container="#company_error">
                                    <?php
                                    foreach ($companymanager as $company){
                                        ?>
                                        <label class="checkbox-inline">
                                            <?php
                                            echo'<input type="checkbox" name="case[]" value="'.$company->getIdCompany().'"';
                                            if($donnees[$company->getNameData()] =="O"){ echo "checked=\"checked\""; }
                                            echo' />';
                                            ?>
                                        </label>
                                        <?php
                                    } ?>
                                </div>
                                <span class="help-block"> Cocher la ou les société(s) affiliée(s) au client </span>
                                <div id="company_error"> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Compte associé au client
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input name="account" id="account" type="text" class="form-control" value="<?php echo $donnees["compte"]; ?>" />
                            </div>
                        </div>
                        <div class="form-group" id="hidden_fields">
                            <label class="control-label col-md-3">Sous-compte associé au client
                                <span class="required"> * </span>
                            </label>
                            <?php
                            /*récupération des sous comptes du client par société */

                            foreach ($companymanager as $company)
                            {
                                ?>
                                <div class="form-row col-md-1" id="subaccount[<?php echo $company->getIdCompany(); ?>]">
                                    <?php
                                    echo '<input type="text" class="form-control" placeholder="'.$company->getNameData().'"  name="subaccount['.$company->getIdCompany().']" value="'.$donnees['sscompte_'.$company->getNameData()].'">';
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Taxes
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <div class="checkbox-list" data-error-container="#tax_error">
                                    <?php
                                    foreach ($taxes as $tax)
                                    {
                                        ?>
                                        <label class="checkbox-inline">

                                            <input type="checkbox" id="taxes[]" name="taxes[]" value="<?php echo $tax->getIdTax(); ?>"  <?php if($tax->getIsDefault()==1){ echo "checked=\"checked\"";} ?> />
                                            <?php echo $tax->getName(); ?>
                                        </label>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <span class="help-block"> Cocher la ou les taxe(s) affiliée(s) au client </span>
                                <div id="company_error"> </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" value="<?php echo $i; ?>" name="row" id="row" />
                        <input type="hidden" value="<?php echo $maxrow; ?>" name="maxrow" id="maxrow" />
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" name="valider" class="btn green">Valider</button>
                                <button type="button" class="btn grey-salsa btn-outline">Annuler</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>

<script type="text/javascript">
  /* window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
            document.forms["client"].submit();
        }

        function autoRefresh(){
            clearTimeout(auto);
            auto = setTimeout(function(){ submitform(); autoRefresh(); }, 1000);
        }
    }*/

  function RemoveBS($Str) {
      $StrArr = str_split($Str); $NewStr = '';
      foreach ($StrArr as $Char) {
          $CharNo = ord($Char);
          if ($CharNo == 163) { $NewStr .= $Char; continue; } // keep £
          if ($CharNo > 31 && $CharNo < 127) {
              $NewStr .= $Char;
          }
      }
      return $NewStr;
  }
</script>