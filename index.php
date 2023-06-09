<?php
session_start();

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/vendor/autoload.php");
require_once(__DIR__ . "/app/Core/Core.php");
require_once(__DIR__ . "/app/Controllers/LoginController.php");
require_once(__DIR__ . "/app/Controllers/DashboardController.php");
require_once(__DIR__ . "/app/Controllers/RegisterController.php");
require_once(__DIR__ . "/app/Controllers/EventController.php");
require_once(__DIR__ . "/app/Controllers/UserController.php");
require_once(__DIR__ . "/app/Controllers/ReviewController.php");
require_once(__DIR__ . "/app/Models/UserModel.php");
require_once(__DIR__ . "/app/Models/EventModel.php");
require_once(__DIR__ . "/app/Models/CategoryModel.php");
require_once(__DIR__ . "/lib/Luiz/Database/Connection.php");
require_once(__DIR__ . "/app/Controllers/AdminController.php");
require_once(__DIR__ . "/app/Models/ReviewModel.php");
$core = new Core;
echo $core->start($_GET);
