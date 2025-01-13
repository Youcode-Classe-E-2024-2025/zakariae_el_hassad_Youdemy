<?php
const APP_VIEWS = __DIR__ . "/src/view/";
const APP_ASSETS = __DIR__ . "/public/";

require_once "./src/config/DatabaseConnection.php";

// model 

require_once "./src/model/Category.php";

// controller 
require_once "./src/controller/CategoryController.php";


// service 
require_once "./src/service/CategotyService.php";

// dao
require_once "./src/DAO/CategoryDao.php";

$categoryController = new CategoryController();

if(isset($_GET["action"])) {
    $action=$_GET["action"];

    switch($action){
        case "save_category":
            $categoryController->save();
            break;
        default :
            echo "sjsisbx";
            break;
    }
}
