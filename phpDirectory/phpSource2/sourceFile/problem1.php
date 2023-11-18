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
        for($i = 0; $i < 5; $i++) {
            for($j = 0; $j <= $i; $j++) {
                echo chr(65 + $j).' ';
            }
			echo '<br>';
        }
        for($i = 3; $i >= 0; $i--) {
            for($j = 0; $j <= $i; $j++) {
                echo chr(65 + $j).' ';
            }
			echo '<br>';
        }
    ?>
</body>
</html>