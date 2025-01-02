<?php

require "repo.php";

//var_dump($_POST);
//die();

if (!isset($_POST["id"])) 
{
    die("id field is not present in query");
}

if (!isset($_POST["table"])) 
{
    die("table field is not present in query");
}

$id = $_POST["id"];
$table = $_POST["table"];

if ($id == 0)
{
    die("id is equal 0");
}
else
{
    if ($table == 'releases')
    {
        remove_release($id);
    }
    else if ($table == 'articles')
    {

    }
    else
    {
        die('table '.$table.' is not found');
    }
}

header("Location: 4.php");
die();

?>