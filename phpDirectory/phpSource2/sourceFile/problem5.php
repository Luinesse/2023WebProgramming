<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 과제 5번</title>
</head>
<body>
    <?php
        $fp = fopen("client.txt", 'r');

        while(!feof($fp)) {
            $text = fgets($fp);
            $split = explode("\t", $text);
            if(intval($split[1]) >= 30) {
                echo $text."<br>";
            }
        }
    ?>
</body>
</html>