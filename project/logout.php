<?php
include_once './helper/functions.php';
logoutUser();
set_flash_message('info', 'Logout successful');
header('Location: login.php');