<script>
//Display a confirmation box when trying to delete an object
function showConfirm(id)
{
    // build the confirmation box
    var c = confirm("Are you sure you wish to delete this item?");
    
    // if true, delete item and refresh
    if(c)
        window.location = "CoffeeOverview.php?delete=" + id;
}
</script>

<?php
require ("Model/CoodepoolModel.php");

//Contains non-database related function for the Coffee page
class CodepoolModel {

    function CreateOverviewTable() {
        $result = "
            <table class='overViewTable'>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b>Id</b></td>
                    <td><b>Name</b></td>
                    <td><b>Type</b></td>
                    <td><b>Price</b></td>
                    <td><b>City</b></td>
                    <td><b>Country</b></td>
                </tr>";

        $codepoolArray = $this->GetCodepoolByType('%');

        foreach ($codepoolArray as $key => $value) {
            $result = $result .
                    "<tr>
                        <td><a href='CodepoolAdd.php?update=$value->id'>Update</a></td>
                        <td><a href='#' onclick='showConfirm($value->id)'>Delete</a></td>
                        <td>$value->id</td>
                        <td>$value->name</td>
                        <td>$value->type</td>    
                        <td>$value->price</td> 
                        <td>$value->city</td>
                        <td>$value->country</td>   
                    </tr>";
        }

        $result = $result . "</table>";
        return $result;
    }

    function CreateCodepoolDropdownList() {
        $codepoolModel = new CodepoolModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Please select a type: 
                    <select name = 'types' >
                        <option value = '%' >All</option>
                        " . $this->CreateOptionValues($this->GetCodepoolTypes()) .
                "</select>
                     <input type = 'submit' value = 'Search' />
                    </form>";

        return $result;
    }

    function CreateOptionValues(array $valueArray) {
        $result = "";

        foreach ($valueArray as $value) {
            $result = $result . "<option value='$value'>$value</option>";
        }

        return $result;
    }

    function CreateCodepoolTables($types) {
        $codepoolModel = new CodepoolModel();
        $codepoolArray = $codepoolModel->GetCodepoolByType($types);
        $result = "";

        //Generate a codeTable for each codeEntity in array
        foreach ($codepoolArray as $key => $codepool) {
            $result = $result .
                    "<table class = 'codepoolTable'>
                        <tr>
                            <th rowspan='6' width = '150px' ><img runat = 'server' src = '$codepool->image' /></th>
                            <th width = '75px' >Name: </th>
                            <td>$codepool->name</td>
                        </tr>
                        
                        <tr>
                            <th>Type: </th>
                            <td>$codepool->type</td>
                        </tr>
                        
                        <tr>
                            <th>Price: </th>
                            <td>$codepool->price</td>
                        </tr>
                        
                        <tr>
                            <th>City: </th>
                            <td>$codepool->city</td>
                        </tr>
                        
                        <tr>
                            <th>Origin: </th>
                            <td>$codepool->country</td>
                        </tr>
                        
                        <tr>
                            <td colspan='2' >$codepool->review</td>
                        </tr>                      
                     </table>";
        }
        return $result;
    }

    //Returns list of files in a folder.
    function GetImages() {
        //Select folder to scan
        $handle = opendir("Images/Codepool");

        //Read all files and store names in array
        while ($image = readdir($handle)) {
            $images[] = $image;
        }

        closedir($handle);

        //Exclude all filenames where filename length < 3
        $imageArray = array();
        foreach ($images as $image) {
            if (strlen($image) > 2) {
                array_push($imageArray, $image);
            }
        }

        //Create <select><option> Values and return result
        $result = $this->CreateOptionValues($imageArray);
        return $result;
    }

    //<editor-fold desc="Set Methods">
    function InsertCodepool() {
        $name = $_POST["txtName"];
        $type = $_POST["ddlType"];
        $price = $_POST["txtPrice"];
        $city = $_POST["txt<City"];
        $country = $_POST["txtCountry"];
        $image = $_POST["ddlImage"];
        $review = $_POST["txtReview"];

        $codepool = new CodeEntity(-1, $name, $type, $price, $city, $country, $image, $review);
        $codepoolModel = new CodepoolModel();
        $codepoolModel->InsertCode($code);
    }

    function UpdateCodepool($id) {
        $name = $_POST["txtName"];
        $type = $_POST["ddlType"];
        $price = $_POST["txtPrice"];
        $city = $_POST["txtCity"];
        $country = $_POST["txtCountry"];
        $image = $_POST["ddlImage"];
        $review = $_POST["txtReview"];

        $codepool = new CodepoolEntity($id, $name, $type, $price, $city, $country, $image, $review);
        $codepoolModel = new CodepoolModel();
        $codepoolModel->UpdateCode($id, $code);
    }

    function DeleteCodepool($id) 
    {
        $codepoolModel = new CodepoolModel();
        $codepoolModel->DeleteCodepool($id);
    }

    //</editor-fold>
    //<editor-fold desc="Get Methods">
    function GetCodepoolById($id) {
        $codepoolModel = new CodepoolModel();
        return $codepoolModel->GetCodepoolById($id);
    }

    function GetCodepoolByType($type) {
        $codepoolModel = new CodepoolModel();
        return $codepoolModel->GetCodepoolByType($type);
    }

    function GetCodepoolTypes() {
        $codepoolModel = new CodepoolModel();
        return $codepoolModel->GetCodepoolTypes();
    }

    //</editor-fold>
}
?>
