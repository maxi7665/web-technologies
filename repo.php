<?php

function init_conn()
{
    $servername = "localhost";
    $username = "root";
    $password = "qwsxza";
    $dbname = "web";

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function get_releases()
{
    $conn = init_conn();

    $sql = "SELECT * FROM releases order by code desc";
    $result = $conn->query($sql);

    $rows = array();

    $row_num = 0;

    if ($result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            $rows[$row_num] = $row;

            $row_num ++;
        }
    }

    $conn->close();

    return $rows;
}

function get_articles()
{
    $conn = init_conn();

    $sql = "SELECT r.code as release_code, a.* FROM releases as r join articles as a on a.release_id = r.id order by publication_date desc";
    $result = $conn->query($sql);

    $rows = array();

    $row_num = 0;

    if ($result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
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

    if ($result->num_rows > 0) 
    {
        // output data of each row
        while ($row = $result->fetch_assoc()) 
        {      
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
        ."'".mysqli_real_escape_string($conn, $row['code'])."',"
        ."'".mysqli_real_escape_string($conn, $row['description'])."',"
        ."'".mysqli_real_escape_string($conn, $row['release_date'])."',"
        ."'".mysqli_real_escape_string($conn, $row['type'])."');";

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

    $conn = init_conn();  

    $sql = "insert into articles(author_name, resource_name, link, publication_date, release_id) values ("
        ."'".mysqli_real_escape_string($conn, $row['author_name'])."',"
        ."'".mysqli_real_escape_string($conn, $row['resource_name'])."',"
        ."'".mysqli_real_escape_string($conn, $row['link'])."',"
        ."'".mysqli_real_escape_string($conn, $row['publication_date'])."',"
        ."'".mysqli_real_escape_string($conn, $release['id'])."');";

    //var_dump($sql);

      
    $result = $conn->query($sql);
    $conn->close();
}

function update_release($release)
{
    update_table($release, 'releases');
}

function update_article($article)
{
    //var_dump($article);

    if (!isset($article['release_code']))
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

    update_table($article, 'articles');
}

function update_table($row, $table)
{
    $id = $row['id'];

    $sql = "update ".$table." set ";

    $is_first = 0;

    $conn = init_conn();

    foreach ($row as $key => $value)
    {
        if ($is_first != 0)
        {
            $sql = $sql.",";
        }

        $sql = $sql." ".$key."='".mysqli_real_escape_string($conn,$value)."'";

        $is_first = 1;
    }

    $sql = $sql." where id=".$id.";";

    //var_dump($sql);

    
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
