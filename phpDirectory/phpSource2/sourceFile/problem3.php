<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 과제 3번</title>
</head>
<body>
    <?php
        $fp = fopen("exam.txt", 'r');
        $lines = 0;
        $word = 0;
        $cnt = 0;

        while(!feof($fp)) {
            $text = fgets($fp);
            $split = explode(' ',$text);
            $lines++;
            $word += count($split);
            $cnt += strlen($text);
        }

        fclose($fp);

        echo "줄 수 : ".$lines."<br>단어 수 : ".$word."<br>글자 수 : ".$cnt;
    ?>
</body>
</html>