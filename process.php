
<?php
    error_reporting(E_ALL); ini_set('display_errors', 1);
define('DB_NAME','Database1');
define('DB_USER','root');
define('DB_PASSWORD','root');
define('DB_HOST','localhost');

$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD, DB_NAME);
$db_selected = mysqli_select_db( $link, DB_NAME);

if(!$link){
    die('error'. mysql_error());
}

if(!$db_selected){
    die('error' . mysql_error());
}

if(isset($_POST['button'])){
	$value = $_POST['username'];
	$sql= "INSERT INTO Demo (username) VALUES ('$value')";
}
else{
	echo('Please login again');
	exit();
}

if (!mysqli_query($link,$sql)){
        die('error' . mysql_error());

}

mysqli_close($link);
echo "Hello Wqworld";
?>