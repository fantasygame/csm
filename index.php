<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        require './MySql.php';

        $mysql = new MySql('localhost', 'root', 'okurwakacper', 'csm');

        $query = "
           SELECT * FROM `attribute`
        ";

        $result = $mysql->select($query);
        
        echo '<pre>';
        print_r($result);
        echo '</pre>';
        
        ?>
    </body>
</html>
