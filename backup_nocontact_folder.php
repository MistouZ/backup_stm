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

$bd = new PDO('mysql:host=localhost;port=3306; dbname=stm_test_db;charset=utf8', 'testuser', 'U!nx837j');
$count = $bd->query('SELECT * FROM folder_nocontact');
$maxrow = $count->rowCount();
$reponse = $bd->query('SELECT * FROM folder_nocontact LIMIT '.$i.',1');
$donnees = $reponse->fetch();

$description = $donnees["description"];


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
                <form action="<?php echo URLHOST."_pages/_post/creer_no_contact_dossier_backup.php"; ?>" method="post" id="dossier" name="dossier" class="form-horizontal">
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
                                <input type="text" name="label" id="label" data-required="1" class="form-control" value="<?php echo $donnees["label"];?>" /> </div>
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
                                <input type="text" data-required="1" class="form-control" name="seller-select" value="<?php echo $donnees["seller"]; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="customer-select">Client
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" id="customerId" name="customerId" value="<?php echo $donnees["customerId"]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="contact-select">Contact
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" data-required="1" class="form-control" name="contact-select" value="11"/>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="idcompany" value="<?php echo $donnees["companyId"];?>" />
                        <input type="hidden" name="folderNumber" value="<?php echo $donnees["folderNumber"];?>" />
                        <input type="hidden" name="isActive" value="<?php echo $donnees["isActive"];?>" />
                        <input type="hidden" name="year" value="<?php echo $donnees["year"];?>" />
                        <input type="hidden" name="month" value="<?php echo $donnees["month"];?>" />
                        <input type="hidden" name="day" value="<?php echo $donnees["day"];?>" />
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