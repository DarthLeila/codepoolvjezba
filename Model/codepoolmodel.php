<?php
require ("Entities/CodepoolEntity.php");

//Contains database related code for the Codepool page.
class CodepoolModel {

    //Get all codepool types from the database and return them in an array.
    function GetCodepoolTypes() {
        require ('Credentials.php');
        //Open connection and Select database.   
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        $result = mysql_query("SELECT DISTINCT type FROM coffee") or die(mysql_error());
        $types = array();

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            array_push($types, $row[0]);
        }

        //Close connection and return result.
        mysql_close();
        return $types;
    }

    //Get codepoolEntity objects from the database and return them in an array.
    function GetCodepoolByType($type) {
        require ('Credentials.php');
        //Open connection and Select database.     
        mysql_connect($host, $user, $passwd) or die(mysql_error);
        mysql_select_db($database);

        $query = "SELECT * FROM codepool WHERE type LIKE '$type'";
        $result = mysql_query($query) or die(mysql_error());
        $coffeeArray = array();

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            $id = $row[0];
            $name = $row[1];
            $type = $row[2];
            $price = $row[3];
            $city = $row[4];
            $country = $row[5];
            $image = $row[6];
            $review = $row[7];

            //Create codepool objects and store them in an array.
            $codepool = new CodepoolEntity($id, $name, $type, $price, $city, $country, $image, $review);
            array_push($codepoolArray, $codepool);
        }
        //Close connection and return result
        mysql_close();
        return $codepoolArray;
    }

    function GetCodepoolById($id) {
        require ('Credentials.php');
        //Open connection and Select database.     
        mysql_connect($host, $user, $passwd) or die(mysql_error);
        mysql_select_db($database);

        $query = "SELECT * FROM codepool WHERE id = $id";
        $result = mysql_query($query) or die(mysql_error());

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            $name = $row[1];
            $type = $row[2];
            $price = $row[3];
            $city = $row[4];
            $country = $row[5];
            $image = $row[6];
            $review = $row[7];

            //Create codepool
            $codepool = new CodepoolEntity($id, $name, $type, $price, $city, $country, $image, $review);
        }
        //Close connection and return result
        mysql_close();
        return $codepool;
    }

    function InsertCodepool(CodepoolEntity $codepool) {
        $query = sprintf("INSERT INTO codepool
                          (name, type, price,city,country,image,review)
                          VALUES
                          ('%s','%s','%s','%s','%s','%s','%s')",
                mysql_real_escape_string($codepool->name),
                mysql_real_escape_string($codepool->type),
                mysql_real_escape_string($codepool->price),
                mysql_real_escape_string($codepool->city),
                mysql_real_escape_string($codepool->country),
                mysql_real_escape_string("Images/Codepool/" . $codepool->image),
                mysql_real_escape_string($codepool->review));
        $this->PerformQuery($query);
    }

    function UpdateCodepool($id, CodepoolEntity $codepool) {
        $query = sprintf("UPDATE codepool
                            SET name = '%s', type = '%s', price = '%s', city = '%s',
                            country = '%s', image = '%s', review = '%s'
                          WHERE id = $id",
                mysql_real_escape_string($codepool->name),
                mysql_real_escape_string($codepool->type),
                mysql_real_escape_string($codepool->price),
                mysql_real_escape_string($codepool->city),
                mysql_real_escape_string($codepool->country),
                mysql_real_escape_string("Images/Codepool/" . $codepool->image),
                mysql_real_escape_string($codepool->review));
                          
        $this->PerformQuery($query);
    }

    function DeleteCoffee($id) {
        $query = "DELETE FROM coffee WHERE id = $id";
        $this->PerformQuery($query);
    }

    function PerformQuery($query) {
        require ('Credentials.php');
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);

        //Execute query and close connection
        mysql_query($query) or die(mysql_error());
        mysql_close();
    }
}
?>

