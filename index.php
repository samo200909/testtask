<?php
$uploaddir = __DIR__ .'/www/local/files/';

if($_GET['del']!=""){
	unlink($uploaddir.$_GET['del']);
	header('Location: index.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Test</title>
    <link href="style.css" rel="stylesheet">
</head>

<form enctype="multipart/form-data" method="POST">
    файл: <input name="userfile" type="file" /><br><br>
    <input type="submit" value="Отправить файл" />
</form>
<br>
<?php

if($_FILES['userfile']['error']===0){
	
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
	
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		echo "<div class='krug'></div>";
	} else {
		echo "<div class='krug red'></div>";
	}

}
echo "<br>";
if ($handle = opendir($uploaddir)) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            echo "<a href='?del=$entry'>x</a> - $entry<br>";
        }
    }

    closedir($handle);
}
?>