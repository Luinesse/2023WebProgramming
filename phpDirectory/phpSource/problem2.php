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
        function fac($a) {
            if($a == 1) return 1;
            else    return $a * fac($a - 1);
        }

        $a = 5;
        echo fac($a);
    ?>
</body>
</html>