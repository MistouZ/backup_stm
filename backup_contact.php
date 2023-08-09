<?php

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


$count = $bd->query('SELECT * FROM dossier GROUP BY client');
$maxrow = $count->rowCount();


$req = $bd->query('SELECT * FROM dossier GROUP BY client LIMIT '.$i.',1 ');
$recup = $req->fetch();




if($recup["contact"] == "" || $recup["contact"] == NULL){
    echo "pas de contact";
    $i++;
    header('Location: http://test.bitwin.nc/backup_contact.php?row=' .$i);
}
else{
    echo $recup["contact"];
    print_r($recup);
    echo 'SELECT * FROM contact_old WHERE nom_contact="'.$recup["contact"].'" AND client = "'.$recup["client"].'"';
    $reponse = $bd->query('SELECT * FROM contact_old WHERE nom_contact="'.$recup["contact"].'" AND client = "'.$recup["client"].'"');
        $donnees = $reponse->fetch();
    if($donnees == null){
        $i++;
        //header('Location: http://test.bitwin.nc/backup_contact.php?row=' .$i);
    }
    else{


    $mr2 = 'M.';
    $mr   = 'Mr';
    $mme = 'Mme';
    $mlle = 'Mlle';
    if(strpos($donnees["nom_contact"], $mr) !== false || strpos($donnees["nom_contact"], $mr2) !== false)
    {
        $donnees["nom_contact"] = substr($donnees["nom_contact"], 3);
        $contact_nom = explode(' ',$donnees["nom_contact"]);
        $prenom = $contact_nom[0];
        $nom = $contact_nom["1"]." ".$contact_nom["2"];


    }
    elseif(strpos($donnees["nom_contact"], $mme)!== false || strpos($donnees["nom_contact"], $mlle)!== false)
    {
        $donnees["nom_contact"] = substr($donnees["nom_contact"], 4);
        $contact_nom = explode(' ',$donnees["nom_contact"]);
        $prenom = $contact_nom[0];
        $nom = $contact_nom["1"]." ".$contact_nom["2"];
    }
    else
    {
        $contact_nom = explode(" ",$donnees["nom_contact"]);
        $prenom = $contact_nom[0];
        $nom = $contact_nom["1"]." ".$contact_nom["2"];
    }

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

    $donnees["client"] = str_replace( $old, $new, $donnees["client"] );

    print_r($donnees);
    }
    ?>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Ajout du contact <span style="font-style: italic; font-weight: 800;"><?php echo $donnees["nom"]; ?></span></span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo URLHOST."_pages/_post/creer_contact_backup.php"; ?>" method="post" id="contact" name="contact" class="form-horizontal">
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button> Une erreur s'est produite, merci de renseigner les champs requis. </div>
                            <div class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button> Le contact a bien été créé </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Nom
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <div class="input-icon right">
                                        <i class="fas"></i>
                                        <input type="text" data-required="1" class="form-control" name="name" value="<?php echo utf8_decode($nom);?>"/> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Prénom
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <div class="input-icon right">
                                        <i class="fas"></i>
                                        <input type="text" data-required="1" class="form-control" name="firstname" value="<?php echo utf8_decode($prenom);?>"/> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Email
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <div class="input-icon right">
                                        <i class="fas"></i>
                                        <input type="email" class="form-control" name="emailAddress" value="<?php echo $donnees["ad_mail"];?>"/> </div>
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="control-label col-md-3">Téléphone
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <div class="input-icon right">
                                        <i class="fas"></i>
                                        <input type="digits" class="form-control" name="phoneNumber" value="<?php echo $donnees["telephone"];?>"/></div>
                                </div>
                            </div>
                            <input type="hidden" id="customerName" name="customerName" value="<?php echo mb_strtoupper($donnees["client"]); ?>">
                            <div>
                                <input type="hidden" value="<?php echo $i; ?>" name="row" id="row" />
                                <input type="hidden" value="<?php echo $maxrow; ?>" name="maxrow" id="maxrow" />
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" name="valider" id="valider" class="btn green">Valider</button>
                                        <button type="button" class="btn default">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
            document.forms["contact"].submit();
        }

        function autoRefresh(){
            clearTimeout(auto);
            auto = setTimeout(function(){ submitform(); autoRefresh(); }, 1000);
        }
    }
</script>