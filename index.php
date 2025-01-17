<?php
const APP_VIEWS = __DIR__ . "/src/view/";
const APP_ASSETS = __DIR__ . "/public/";



require_once "./src/config/DatabaseConnection.php";

// model 

require_once "./src/model/Category.php";
require_once "./src/model/User.php";
require_once "./src/model/Role.php";
require_once "./src/model/Tag.php";
require_once "./src/model/Course.php";

// controller 
require_once "./src/controller/CategoryController.php";
require_once "./src/controller/UserController.php";
require_once "./src/controller/TagController.php";
require_once "./src/controller/CourseController.php";


// service 
require_once "./src/service/CategotyService.php";
require_once "./src/service/UserService.php";
require_once "./src/service/TagService.php";
require_once "./src/service/CourseService.php";

// dao
require_once "./src/DAO/CategoryDao.php";
require_once "./src/DAO/UserDao.php";
require_once "./src/DAO/TagDao.php";
require_once "./src/DAO/CourseDao.php";
require_once "./src/dao/CourseTagDao.php";

$categoryController = new CategoryController();
$userController = new UserController();
$tagContrioller = new TagController();
$courseController = new CourseController();
session_start();

if(isset($_GET["action"])) {
    $action=$_GET["action"];

    switch($action){
        case "register-form":
            $userController->showRegisterForm();
            break;
        case "register-submit":
            $userController->submitRegister();
            break;
        case "login-form":
            $userController->showLoginForm();
            break;
        case "login-submit":
            $userController->submitLogin();
            break;
        case "logout":
            $userController->logout();
            break;
        case "admin":
            $userController->get3User();
            break;
        case "tout-user":
            $userController->getAll();
            break;
        case "home":
            $userController->home();
            break;
        case "logout":
            $userController->logout();
            break;
        case "save_category" :
            $categoryController->save();
            break;
        case "category":
            $categoryController->getAll();
            break;
        case "tout-Category":
            $categoryController->getAll2();
            break;
        case "delet-category":
            $categoryController->delete();
            break;
        case "save_tag":
            $tagContrioller->save();
            break;
        case "tags":
            $tagContrioller->getAll();
            break;
        case "save_course":
            $courseController->save();
            break;
        case "course":
            $courseController->getAll();
            break;
        case "ton_course" :
            $courseController->getAllByUser();
            break;
        case "course_documment" : 
            $courseController->showCourseDetail();
            break;
        default :
            echo "sjsisbx";
            break;
    }
}
