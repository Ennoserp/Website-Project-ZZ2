<html>
    <head>
        <title>Tables de multiplications</title>
    </head>

    <body>
        <style>
            table, td{
                border:1px solid lightgrey;
                border-collapse: collapse;

            }

        </style>
        <table>
        <?php
            for($i = 0 ; $i <=10; $i++){
                echo '<td>';
                for($j = 0 ; $j <=10; $j++){
                    echo $i.' x '. $j . ' = ' . $i * $j . '<br />';
                }
                echo '</td>';
            }
        ?>
        </table>
    </body>
</html>