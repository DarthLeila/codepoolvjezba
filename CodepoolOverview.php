<?php
$title = "Manage codepool objects";
include './Controller/codepoolcontroller.php';
$codepoolController = new CodepoolController();

$content = $codepoolController->CreateOverviewTable();

if(isset($_GET["delete"]))
{
    $codepoolController->DeleteCodepool($_GET["delete"]);
}
        
include './Template.php';      
?>
