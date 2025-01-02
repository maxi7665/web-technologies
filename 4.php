<?php
  require "repo.php"; 
?>

<html>

<head>
    <title>Язык Kotlin</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/kotlin_logo.png" />
    <link rel="stylesheet" type="text/css" href="4.css">

    <meta charset="UTF-8">
    <!-- meta - дополнительное задание -->
    <meta name="description" content="Kotlin programming language">
    <meta name="keywords" content="Kotlin, Java, JVM, JDK">
    <meta name="author" content="Maxim Bystrov">
</head>

<!-- дополнительное задание - использование события окна браузера -->
<body>
    <div id="container" class="container">

        <!-- шапка - обязательный элемент сайта -->
        <div id="header">
            <div id="logo"><img src="img/kotlin_logo.png"></div>

            <h2 id="sitename">Язык Kotlin</h2>


            <h3 id="pagename">Статьи</h3>


        </div>

        <!-- навигация между страницами - обязательный элемент сайта -->
        <div id="navigation" class="container">
            <h2><a href="1.html">История</a>
                <a href="2.html">Документация</a>
                <a href="3.html">Источники</a>
                <a href="4.php">Статьи</a>
            </h2>
        </div>

        </p>

        <!-- боковая панель -->
        <div id="sidebar">
            <h2>Новости</h2>
            <h3><a href="https://kotlinlang.org/docs/releases.html">Release Notes</a></h3>
            <h3><a href="https://blog.jetbrains.com/kotlin/2024/11/kotlin-roundup-kodee-s-top-picks/">Kotlin Roundup</a>
            </h3>
            <h3><a href="https://blog.jetbrains.com/kotlin/2024/10/ktor-3-0/">Вышел Ktor 3.0</a></h3>
        </div>

        <!-- основной контент -->
        <div id="content">

            <h2>Выпуски</h2>

            <?php
                $rows = get_releases();

                for ($i = 0; $i <= sizeof($rows); $i++)
                {
                    if ($i < sizeof($rows))
                    {
                        $row = $rows[$i];
                        $id = $row["id"];
                    }
                    else
                    {
                        $id = 0;
                    }

                    // формы для обновления / удаления каждой строки
                    echo "<form id=\"releaseDelete".$id."\" action=\"delete.php\" method=\"post\"></form>";
                    echo "<form id=\"releaseUpdate".$id."\" action=\"update.php\" method=\"post\"></form>";

                    // данные об идентификаторах
                    echo "<input form=\"releaseDelete".$id."\" type=\"hidden\" name=\"id\" value=\"".$id."\" />";
                    echo "<input form=\"releaseUpdate".$id."\" type=\"hidden\" name=\"id\" value=\"".$id."\" />";

                    // данные об объекте обновления
                    echo "<input form=\"releaseDelete".$id."\" type=\"hidden\" name=\"table\" value=\"releases\" />";
                    echo "<input form=\"releaseUpdate".$id."\" type=\"hidden\" name=\"table\" value=\"releases\" />";
                }
            ?>

            <table>
                <td>Код</td><td>Описание</td><td>Дата</td><td>Тип</td>

                <?php

                for ($i = 0; $i <= sizeof($rows); $i++)
                {
                    if ($i < sizeof($rows))
                    {
                        $row = $rows[$i];
                        $id = $row["id"];
                    }
                    else
                    {
                        $row = array();
                        $id = 0;
                    }

                    echo "<tr>";  
                    
                    echo "<td><input name=\"code\" form=\"releaseUpdate".$id."\" value=\"".(isset($row['code']) ? $row['code'] : "")."\"></td>";
                    echo "<td><input name=\"description\" form=\"releaseUpdate".$id."\" value=\"".(isset($row['description']) ? $row['description'] : "")."\"></td>";
                    echo "<td><input name=\"release_date\" form=\"releaseUpdate".$id."\" value=\"".(isset($row['release_date']) ? $row['release_date'] : "")."\"></td>";
                    echo "<td><input name=\"type\" form=\"releaseUpdate".$id."\" value=\"".(isset($row['type']) ? $row['type'] : "")."\"></td>";
                    echo "<td><input type=\"submit\" form=\"releaseUpdate".$id."\" value=\"".($id != 0 ? "Обновить" : "Добавить")."\"></td>";

                    if ($i < sizeof($rows))
                    {
                        echo "<td><input type=\"submit\" form=\"releaseDelete".$id."\" value=\"Удалить\"></td>";
                    }
                    
                    echo "</form>";
                    echo "</tr>";
                }
            ?>

            </table>

            <?php
                for ($i = 0; $i <= 4; $i++)
                {
                    echo "<form id=\"article".$i."\" action=\"delete.php\" method=\"post\"></form>";
                }
            ?>

            <table>

            <?php
                for ($i = 0; $i <= 4; $i++)
                {
                    echo "<tr>";                   

                    echo "<td><input form=\"".$i."\">>1</td>1<td>1</td><td><input type=\"submit\" form=\"".$i."\" value=\"Удалить\"></td>";                    

                    echo "</tr>";
                }
            ?>

            </table>

        </div>

        <div id="clear"> </div>

        <!-- подвал - обязательный элемент сайта -->
        <div id="footer">
            <h2>Контакты</h2>
            <p>
                <a href="https://github.com/maxi7665">GitHub</a>
            </p>
            <a href="https://github.com/maxi7665/web-technologies">Исходный код сайта</a>
            </p>
        </div>
    </div>
</body>

</html>