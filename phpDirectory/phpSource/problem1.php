<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 과제 1번</title>
</head>
<body>
    <?php
        function numCheck($a) {
            if ($a % 2 == 1) {
				$a = $a + 1;
                echo "$a<br>";
            } else {
                echo "$a<br>";
            }
        }

        $a = 1;
        echo "a가 홀수 인 경우 현재 a : $a<br>";
        numCheck($a);

        $a = 4;
        echo "a가 짝수 인 경우 현재 a : $a<br>";
        numCheck($a);
    ?>
</body>
</html>