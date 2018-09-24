<?php

require 'Controller/codepoolcontroller.php';
$codepoolController = new CodepoolController();

if(isset($_POST['types']))
{
    //Fill page with codepool of the selected type
    $codepoolTables = $codepoolController->CreateCodepoolTables($_POST['types']);
}
else 
{
    //Page is loaded for the first time, no type selected -> Fetch all types
    $codepoolTables = $codepoolController->CreateCodepoolTables('%');
}

//Output page data
$title = 'Codepool overview';
$content = $codepoolController->CreateCodepoolDropdownList(). $codepoolTables;

include 'Template.php';
?>