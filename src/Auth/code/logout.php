<?php
session_start();
unset($_SESSION['user']);
header("location: ../code/login.php");