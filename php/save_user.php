<?php
if (isset($_POST['login'])) { 
	$login = $_POST['login']; 
	if ($login == '') { 
		unset($login);
	} 
}
if (isset($_POST['password'])) { 
	$password=$_POST['password']; 
	if ($password =='') {
	 unset($password);
	} 
}
if (isset($_POST['password2'])) { 
	$password2=$_POST['password2']; 
	if ($password2 =='') {
	 unset($password2);
	} 
}
if (isset($_POST['reg_mail'])) { 
    $reg_mail=$_POST['reg_mail']; 
    if ($reg_mail =='') {
     unset($reg_mail);
    } 
}
if (empty($login) or empty($password) or empty($password2) or empty($reg_mail)){
exit ("Ви повинні заповнити усі поля, їх і так не багато!");
}
if ($password != $password2) {
	exit ("Введені паролі не збігаються!");
}
$login = stripslashes($login);
$login = htmlspecialchars($login);
$password = stripslashes($password);
$password = htmlspecialchars($password);
$login = trim($login);
$password = trim($password);
if    (strlen($login) < 3 or strlen($login) > 32) {
exit    ("Логін повинен складатися не менш ніж з 3 символів, і не більше ніж з 32");
}
if    (strlen($password) < 3 or strlen($password) > 32) {
exit    ("Пароль повинен складатися не менш ніж з 3 символів, і не більше ніж з 32");
}

$password = md5($password);
$password = strrev($password);//+реверс        
$password = $password."b3p6f";

include ("bd.php");
$result = mysql_query("SELECT id FROM users WHERE login='$login' LIMIT 1",$db);
$myrow = mysql_fetch_array($result);
if (!empty($myrow['id'])) {
exit ("Такий логін вже зареєстровано в системі");
}

$result2 = mysql_query ("INSERT INTO users (login,password,reg_mail) VALUES('$login','$password','$reg_mail')");
if ($result2=='TRUE'){
echo "Ви успішно зареєстровані <a href='index.php'>На головну</a>";
} else {
echo "Сталася якась помилка!";
     }
?>