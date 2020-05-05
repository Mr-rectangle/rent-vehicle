<?php

if (isset($_COOKIE['user_id'])){
	unset($_COOKIE['user_id']);
setcookie('user_id', null, -1, '/');
// setcookie("user_id", "", 0);
header("Location: /");

}
?>