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
            $this->userService->register($_POST);
            require_once APP_VIEWS . "login.php";
        }

        public function showLoginForm()
        {
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

    if ($response['user']->getRole()->getId() == 1 && $response['user']->getRole()->getId() == 2) { 
        header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=category");
    } else {
        header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=login-form");
    }
    exit();
}


        public function getAll()
        {
            $users = $this->userService->getAllByRoleId(2);
            require_once APP_VIEWS . "toutLesUser.php";
        }

        public function get3User()
        {
            $tags = $this->tagService->getAllTag();
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
            require_once APP_VIEWS . "home.php";
        }
    }
