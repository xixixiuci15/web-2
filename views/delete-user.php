<?php
require_once __DIR__ . '/../models/User.php';

use models\User;

if(isset($_GET['id'])){
    header("location: List-user.php");
    exit();
}
$user = User::find($_GET['id']);

if (!$user) {
    header("Location: List-user.php");
    exit();
}
user ::delete(($user['id']));
header("Location: List-user.php");
?>
