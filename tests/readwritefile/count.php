<?php 
    //$filename = fopen('/srv/files/data/ocr_readwritefile_count.txt', 'a+');
    $filename = fopen('/srv/files/data/ocr_readwritefile_count.txt', 'r+');
    //$car = fgetc($filename);
    $line = htmlspecialchars(fgets($filename));
    $count = 0;
    if ($line != null AND $line != "")
    {
        $line = (int)$line;
        if ($line != 0)
        {
            $count = $line;
        }
    }
    $count++;
    fseek($filename, 0);
    fputs($filename, $count);
    
    fclose($filename);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Read write file</title>
    </head>

    <body>
        <h1>Cette page a été visitée <?php echo $count; ?> fois depuis sa création.</h1>
    </body>

</html>