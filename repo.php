<?php

function init_conn()
{
    $servername = "localhost";
    $username = "root";
    $password = "qwsxza";
    $dbname = "web";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // $sql = "SELECT id, firstname, lastname FROM MyGuests";
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    //     // output data of each row
    //     while ($row = $result->fetch_assoc()) {
    //         echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
    //     }
    // } else {
    //     echo "0 results";
    // }
    // $conn->close();

    return $conn;
}

function get_releases()
{
    $conn = init_conn();

    $sql = "SELECT * FROM releases";
    $result = $conn->query($sql);

    $rows = array();

    $row_num = 0;

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";

            $rows[$row_num] = $row;

            $row_num ++;
        }
    }

    $conn->close();

    return $rows;
}

function get_release_by_code($code)
{
    $conn = init_conn();

    $sql = "SELECT * FROM releases where code='".$code."';";
    $result = $conn->query($sql);

    $release = array();

    $row_num = 0;

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {      
            $release = $row;
        }
    }

    $conn->close();

    return $release;
}

function add_release($row)
{
    $conn = init_conn();

    $sql = "insert into releases(code, description, release_date, type) values ("
        ."'".$row['code']."',"
        ."'".$row['description']."',"
        ."'".$row['release_date']."',"
        ."'".$row['type']."');";

    //var_dump($sql);

    $result = $conn->query($sql);

    $conn->close();
}


function add_article($row)
{
    if (!isset($row['release_code']))
    {
        die('release code is not present in query');
    }    

    $release = get_release_by_code($row['release_code']);

    if (!isset($release['id']))
    {
        die('release with code '.$row['release_code'].' is not found');
    }    

    $sql = "insert into articles('author_name', 'resource_name', 'link', 'publication_date', 'release_id') values ("
        ."'".$row['author_name']."',"
        ."'".$row['resource_name']."',"
        ."'".$row['link']."',"
        ."'".$row['publication_date']."',"
        ."'".$release['id']."');";

    //var_dump($sql);

    $conn = init_conn();    
    $result = $conn->query($sql);
    $conn->close();
}

function update_release($release)
{
    update_table($release, 'releases');
}

function update_article($article)
{
    if (!isset($row['release_code']))
    {
        die('release code is not present in query');
    }   

    $release = get_release_by_code($article['release_code']);

    if (!isset($release['id']))
    {
        die('release with code '.$article['release_code'].' is not found');
    }  

    $article['release_id'] = $release['id'];
    unset($article['release_code']);

    update_table($release, 'articles');
}

function update_table($row, $table)
{
    $id = $row['id'];

    $sql = "update ".$table." set ";

    $is_first = 0;

    foreach ($row as $key => $value)
    {
        if ($is_first != 0)
        {
            $sql = $sql.",";
        }

        $sql = $sql." ".$key."='".$value."'";

        $is_first = 1;
    }

    $sql = $sql." where id=".$id.";";

    //var_dump($sql);

    $conn = init_conn();
    $result = $conn->query($sql);
    $conn->close();
}

function remove_release($id)
{
    remove_from($id, 'releases');
}

function remove_article($id)
{
    remove_from($id, 'articles');
}

function remove_from($id, $table)
{
    $conn = init_conn();

    $sql = "delete from ".$table." where id=".$id.";";

    var_dump($sql);

    $result = $conn->query($sql);

    $conn->close();
}






?>
