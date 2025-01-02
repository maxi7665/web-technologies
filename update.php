<?php

require 'repo.php';

//var_dump($_POST);
//die();

function prepare_release_row()
{
    $row = array();

    $row['id'] = $_POST['id'];
    $row['code'] = $_POST['code'];
    $row['description'] = $_POST['description'];
    $row['release_date'] = $_POST['release_date'];
    $row['type'] = $_POST['type'];

    return $row;
}

function prepare_article_row()
{
    $row = array();

    $row['id'] = $_POST['id'];
    $row['author_name'] = $_POST['author_name'];
    $row['resource_name'] = $_POST['resource_name'];
    $row['link'] = $_POST['link'];
    $row['publication_date'] = $_POST['publication_date'];
    $row['release_code'] = $_POST['release_code'];

    return $row;
}

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
    if ($table == 'releases')
    {
        $row = prepare_release_row();

        add_release($row);
    }
    else if ($table == 'articles')
    {
        $row = prepare_article_row();

        add_article($row);
    }
    else
    {
        die('table '.$table.' is not found');
    }
}
else
{
    if ($table == 'releases')
    {
        $row = prepare_release_row();

        update_release($row);
    }
    else if ($table == 'articles')
    {
        $row = prepare_article_row();

        update_article($row);
    }
    else
    {
        die('table '.$table.' is not found');
    }
}

header("Location: 4.php");
die();

?>