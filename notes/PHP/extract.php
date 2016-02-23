<!doctype Html>
<html>
<head>
<title></title>
</head>
<body>

<?php
if(isset($_GET['s'])) :
$target_path = dirname(__FILE__)."/".$_GET['s'];
$zip = new ZipArchive;
if ($zip->open($target_path) === TRUE) {
    $zip->extractTo(dirname(__FILE__)."/".$_GET['d']);
    $zip->close();
    echo 'ok';
} else {
    echo 'failed </br>';
    echo $target_path;
}
else : 
?>
<form target="_self" type="GET">
	<input type="text" name="s" placeholder="Source file" />
	<input type="text" name="d" placeholder="Destination Dir"/>
	<button type="submit">Extract</button>
</form>
<?php 	
endif;
?>
</body>
</html>