<?php
include '_cfg/cfg.php';
include '_cfg/fonctions.php';

$folderId =$_GET["folderId"];
$invoice_row = $_GET["invoice"];


$bd = new PDO('mysql:host=localhost;port=3306; dbname=stm_test_db;charset=utf8', 'testuser', 'U!nx837j');
$reponse = $bd->query('SELECT * FROM dossier WHERE id='.$folderId.' ');
$donnees = $reponse->fetch();


$array = array();

//initilisation des objets
$company = new Company($array);
$companymanager = new CompaniesManager($bdd);

$user = new Users($array);
$usermanager = new UsersManager($bdd);

$customer = new Customers($array);
$customermanager = new CustomersManager($bdd);

//récupération des contacts du client
$arrayContact = array();
$contacts = new Contact($arrayContact);
$contactmanager = new ContactManager($bdd);

//récupération des objets en base
$company = $companymanager->getByNameData($donnees["societe"]);
echo $donnees["commercial"];


if(!empty($donnees["commercial"]))
{
    $seller = explode(' ',$donnees["commercial"]);
    $user = $usermanager->findByName($seller[0], $seller[1]);
}
else{
    if($donnees["societe"] == "itech")
    {
        $user->setUsername("xmege");
    }
    elseif ($donnees["societe"] == "concerto")
    {
        $user->setUsername("smaillet");
    }
    elseif ($donnees["societe"] == "concept")
    {
        $user->setUsername("bmege");
    }
    elseif ($donnees["societe"] == "cmg")
    {
        $user->setUsername("ndewynter");
    }
    elseif ($donnees["societe"] == "bitwin")
    {
        $user->setUsername("orodrigue");
    }

}

echo $donnees["client"];


$description = str_replace ("<br />"," ",nl2br(utf8_decode($donnees["description"])));

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

$donnees["contact"] = str_replace( $old, $new, $donnees["contact"] );
//$donnees["libelle"] = htmlspecialchars_decode($donnees["libelle"]);


$mr2 = 'M.';
$mr   = 'Mr';
$mme = 'Mme';
$mlle = 'Mlle';
if(strpos($donnees["contact"], $mr) !== false || strpos($donnees["contact"], $mr2) !== false)
{
    $donnees["contact"] = substr($donnees["contact"], 3);
    $contact_nom = explode(' ',$donnees["contact"]);
    $prenom = $contact_nom[0];
    $nom = $contact_nom["1"]." ".$contact_nom["2"];


}
elseif(strpos($donnees["contact"], $mme)!== false || strpos($donnees["contact"], $mlle)!== false)
{
    $donnees["contact"] = substr($donnees["contact"], 4);
    $contact_nom = explode(' ',$donnees["contact"]);
    $prenom = $contact_nom[0];
    $nom = $contact_nom["1"]." ".$contact_nom["2"];
}
else
{
    $contact_nom = explode(" ",$donnees["contact"]);
    $prenom = $contact_nom[0];
    $nom = $contact_nom["1"]." ".$contact_nom["2"];
}

$donnees["client"] = mb_strtoupper($donnees["client"]);

$contacts = $contactmanager->getByName(strtoupper($nom), $prenom);
$data = array();
$customer = new Customers($data);
$customermanager = new CustomersManager($bdd);
$customer = $customermanager->getByName($donnees["client"]);




if(empty($customer))
{
    echo "je suis passé par ici";
    $donnees["client"] = str_replace("&#039;", "\'", $donnees["client"]);
    echo $donnees["client"];
    $customer = $customermanager->getByName($donnees["client"]);
}

if(empty($customer))
{
    echo "je suis passé par ici";
    $donnees["client"] = str_replace($old, $new, $donnees["client"]);
    echo $donnees["client"];
    $customer = $customermanager->getByName($donnees["client"]);
}

if (empty($customer))
{
    echo "je suis passé par là";
    $donnees["client"] = str_replace( "\'", 'Â€™', $donnees["client"] );
    $donnees["client"] = str_replace( $old, $new, $donnees["client"] );
    echo $donnees["client"];
    $data = array();
    $customer = new Customers($data);
    $customermanager = new CustomersManager($bdd);
    $customer = $customermanager->getByName($donnees["client"]);
}

?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings"></i>
                    <span class="caption-subject sbold uppercase">Création d'un dossier</span>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?php echo URLHOST."_pages/_post/creer_miss_dossier_invoice.php"; ?>" method="post" id="dossier" name="dossier" class="form-horizontal">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button> Une erreur s'est produite, merci de renseigner les champs requis. </div>
                        <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button> Le dossier a bien été créé </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="label">Intitulé du dossier
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="label" id="label" data-required="1" class="form-control" value="<?php echo utf8_decode($donnees["libelle"]);?>" /> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="description">Description
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input name="description" id="description" type="text" class="form-control" value="<?php echo $description;?>" /> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="seller-select">Commercial
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" data-required="1" class="form-control" name="seller-select" value="<?php echo $user->getUsername(); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="customer-select">Client
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" id="customerId" name="customerId" value="<?php echo $customer->getIdCustomer(); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="contact-select">Contact
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" data-required="1" class="form-control" name="contact-select" value="<?php echo $contacts->getIdContact();?>"/>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="idcompany" value="<?php echo $company->getIdcompany();?>" />
                        <input type="hidden" name="folderNumber" value="<?php echo $donnees["num_doss"];?>" />
                        <input type="hidden" name="isActive" value="<?php echo $donnees["etat"];?>" />
                        <input type="hidden" name="year" value="<?php echo $donnees["annee"];?>" />
                        <input type="hidden" name="month" value="<?php echo $donnees["mois"];?>" />
                        <input type="hidden" name="day" value="<?php echo $donnees["jour"];?>" />
                        <input type="hidden" value="<?php echo $invoice_row; ?>" name="row" id="row" />
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
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
            document.forms["dossier"].submit();
        }

        function autoRefresh(){
            clearTimeout(auto);
            auto = setTimeout(function(){ submitform(); autoRefresh(); }, 1000);
        }
    }
</script>