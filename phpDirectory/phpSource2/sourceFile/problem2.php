<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 과제 2번</title>
</head>
<body>
    <?php
        $arr = array(5,2,9,6,3,8);

        function revsort($a) {
            sort($a);
			return array_reverse($a);
        }

        $arr2 = revsort($arr);
        for($i = 0; $i < 6; $i++) {
            echo $arr2[$i]." ";
        }
    ?>
</body>
</html>