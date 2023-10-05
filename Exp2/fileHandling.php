<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
 <style>
        body {
            background-color: #f0e6f2; 
        }
    </style>
</head>
<body>
<?php
 echo "<br><h2>FILE HANDLING</h2>";
 echo "<b>Reading file using fread: </b><br>";
$myfile = fopen("swiftie.txt", "r") or die("Unable to open file!");
 echo fread($myfile,filesize("swiftie.txt"));
 fclose($myfile);
echo "<br>";
//  echo readfile("swiftie.txt");
 echo "<br>";
echo "<br>";
 echo "<b>Reading file using feof: </b><br>";
$myfile = fopen("swiftie.txt", "r") or die("Unable to open file!");
 $file = fopen("swiftie.txt","r");
 
 while(! feof($file)) {
 $line = fgets($file);
 echo $line. "<br>";
 }
 fclose($myfile);
echo "<br>";
 echo "<b>Writing in a file: </b><br>";
$myfile = fopen("swiftie.txt", "w") or die("Unable to open file!");
 $txt = "This is web programming-II\n";
 fwrite($myfile, $txt); 
 $txt = "Hey I am Mehak.\n";
 fwrite($myfile, $txt);
 $txt = "Hope you are having a great Day";
fwrite($myfile, $txt);
 $myfile = fopen("swiftie.txt", "r") or die("Unable to open file!");
 echo fread($myfile,filesize("swiftie.txt"));
 fclose($myfile);
?>
 
</body>
</html>