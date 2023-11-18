<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 과제 4번</title>
</head>
<body>
    <?php
        $arr = array("Kim" => "Seoul", "Lee" => array("Pusan", "Daegu"), "Choi" => "Inchon", "Park" => array("Suwon", "Daejon"), "Jung" => array("Kwangju", "ChunChon", "Wonju"));
        unset($arr["Choi"]);

        foreach($arr as $key => $value) {
            if(is_array($value)) {
                echo $key.' ';
                for($i = 0; $i < count($value); $i++) {
                    echo $value[$i].' ';
                }
            } else {
                echo $key.' '.$value;
            }
            echo "<br>";
        }
    ?>
</body>
</html>