<?php
require './Controller/codepoolcontroller.php';
$codepoolController = new CodepooleController();

$title = "Add a new codepoolproject";

if(isset($_GET["update"]))
{
    $codepool = $codepoolController->GetCodepoolById($_GET["update"]);
    
    $content ="<form action='' method='post'>
    <fieldset>
        <legend>Add a new Codepoolproj</legend>
        <label for='name'>Name: </label>
        <input type='text' class='inputField' name='txtName' value='$codepool->name'  /><br/>

        <label for='type'>Type: </label>
        <select class='inputField' name='ddlType'>
            <option value='%'>All</option>"
        .$codepoolController->CreateOptionValues($codepoolController->GetCodepoolTypes()).
        "</select><br/>

        <label for='price'>Price: </label>
        <input type='text' class='inputField' name='txtPrice' value='$codepool->price'/><br/>

        <label for='roast'>Roast: </label>
        <input type='text' class='inputField' name='txtRoast' value='$codepool->city' /><br/>

        <label for='country'>Country: </label>
        <input type='text' class='inputField' name='txtCountry' value='$codepool->country' /><br/>

        <label for='image'>Image: </label>
        <select class='inputField' name='ddlImage'>"
        .$codepoolController->GetImages().
        "</select></br>

        <label for='review'>Review: </label>
        <textarea cols='70' rows='12' name='txtReview'>$codepool->review</textarea></br>

        <input type='submit' value='Submit'>
    </fieldset>
</form>";
}
 else 
{
    $content ="<form action='' method='post'>
    <fieldset>
        <legend>Add a new Codepoolproj</legend>
        <label for='name'>Name: </label>
        <input type='text' class='inputField' name='txtName' /><br/>

        <label for='type'>Type: </label>
        <select class='inputField' name='ddlType'>
            <option value='%'>All</option>"
        .$codepoolController->CreateOptionValues($codepoolController->GetCodepoolTypes()).
        "</select><br/>

        <label for='price'>Price: </label>
        <input type='text' class='inputField' name='txtPrice' /><br/>

        <label for='city'>City: </label>
        <input type='text' class='inputField' name='txtCity' /><br/>

        <label for='country'>Country: </label>
        <input type='text' class='inputField' name='txtCountry' /><br/>

        <label for='image'>Image: </label>
        <select class='inputField' name='ddlImage'>"
        .$codepoolController->GetImages().
        "</select></br>

        <label for='review'>Review: </label>
        <textarea cols='70' rows='12' name='txtReview'></textarea></br>

        <input type='submit' value='Submit'>
    </fieldset>
</form>";
}


if(isset($_GET["update"]))
{
    if(isset($_POST["txtName"]))
    {
        $codepoolController->UpdateCodepool($_GET["update"]);
    }
}
else
{
    if(isset($_POST["txtName"]))
    {
        $codepoolController->InsertCodepool();
    }
}

include './Template.php';
?>



