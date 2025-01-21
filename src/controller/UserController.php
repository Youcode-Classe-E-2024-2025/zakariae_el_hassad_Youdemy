    <?php

    class UserController
    {
        private UserService $userService;
        private CategoryService $categoryService;
        private TagService $tagService;

        public function __construct()
        {
            $this->userService = new UserService();
            $this->categoryService = new CategoryService();
            $this->tagService = new TagService();
        }
        public function showRegisterForm()
        {
            require_once APP_VIEWS . "singup.php";
        }

        public function submitRegister()
        {
            $imagePath = null;
        if (!empty($_FILES['image']['name'])) {
            $uploadDir = "uploads/";
            $imageName = time() . "_" . basename($_FILES['image']['name']); 
            $imagePath = $uploadDir . $imageName;
    
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $_SESSION["error"] = "Erreur lors du téléchargement de l'image.";
                header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=register-form");
                exit();
            }
        }
    
        $_POST['image'] = $imagePath; 
            $this->userService->register($_POST);
            require_once APP_VIEWS . "login.php";
        }

        public function showLoginForm()
        {
            // $this->logout();
            require_once APP_VIEWS . "login.php";
        }

        public function submitLogin()
{
    session_start();

    $response = $this->userService->login($_POST);
    if (!$response["logged"]) {
        header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=login-form&message={$response['message']}");
        exit();
    }

    session_reset();
    $_SESSION['user'] = $response['user'];
    $_SESSION['logged'] = true;
    
    if ($response['user']->getRole()->getId() == 1) { 
        header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=admin");
    } 
    else if($response['user']->getRole()->getId() == 2) {
        header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=ton_course");
    }
    else if($response['user']->getRole()->getId() == 3) {
        header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=category");
    }
    else {
        header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=login-form");
    }
    exit();
}


        public function getAll()
        {
            $roleIds = [2, 3]; 
            $users = $this->userService->getAllByRoleIds($roleIds);
            require_once APP_VIEWS . "toutLesUser.php";
        }


        public function get3User()
        {
            
            $tags = $this->tagService->get10tags();
            $categorys = $this->categoryService->get3Category();
            $users = $this->userService->get3UserByRoleId(2);
            require_once APP_VIEWS . "admin.php";
        }

        public function logout(){
            session_start();
            session_unset();
            session_destroy();
            header("Location: ?action=login-form");
            exit;
        }

        public function home(){
            $roleIds = [2]; 
            $users = $this->userService->getAllByRoleIds($roleIds);
            require_once APP_VIEWS . "home.php";
        }

        public function delete(){
            if (isset($_GET['user_id'])) {
                $userId = $_GET['user_id']; 
               
                $this->userService->delete($userId); 
            }
        
            $roleIds = [2, 3]; 
            $users = $this->userService->getAllByRoleIds($roleIds);
            require_once APP_VIEWS . "toutLesUser.php";
        }

        public function toggleActive()
        {
            if (!isset($_GET['id'])) {
                header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=users&message=ID is missing");
                exit();
            }
        
            $userId = $_GET['id'];
            $user = $this->userService->getById($userId);
        
            if (!$user) {
                header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=users&message=User not found");
                exit();
            }
        
            $newActiveStatus = $user->getActive() == 1 ? 0 : 1;
            $this->userService->updateActiveStatus($userId, $newActiveStatus);
            $user = $this->userService->getById($userId);


            $tags = $this->tagService->get10tags();
            $categorys = $this->categoryService->get3Category();
            $users = $this->userService->get3UserByRoleId(2);
            require_once APP_VIEWS . "admin.php";
        }
    }
