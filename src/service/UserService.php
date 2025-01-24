<?php

class UserService
{
    private UserDao $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function register(array $data)
    {
        if ($this->userDao->getByEmail($data["email"])) {
            echo "email and password already taken";
            return;
        }

        if ($data["password"] !== $data["confirm_password"]) {
            echo "passwrods are not equal";
            return;
        }

        $hashedPassword = password_hash($data["password"], PASSWORD_DEFAULT);
       $role = new Role();
        $role->setId($data["role_id"]);

        $user = new User(
            name: $data["name"],
            email: $data["email"],
            password: $hashedPassword,
            image: $data["image"] ?? null,
            role: $role
        );
        $id = $this->userDao->create($user);
        $user->setId($id);
    }

    public function login(array $data) 
{
    $user = $this->userDao->getByEmail($data["email"]);
    if (!$user) {
        return [
            "logged" => false,
            "message" => "User not found"
        ];
    }   

    if ($user->getActive() == 0) {
        return [
            "logged" => false,
            "message" => "Votre compte est désactivé"
        ];
    }

    if (!password_verify($data["password"], $user->getPassword())) {
        return [
            "logged" => false,
            "message" => "Password is incorrect"
        ];
    }
    return [
        "logged" => true,
        "message" => "User logged in successfully",
        "user" => $user
    ];
}

    public function getAllByRoleIds($roleIds) : array
    {
        return $this->userDao->getAllByRoleIds($roleIds);
    }

    public function get3UserByRoleId() : array
    {
        return $this->userDao->getLast3UsersByRoles();
    }
    public function delete($id){
        return $this->userDao->delete($id);
    }

    public function updateActiveStatus($userId , $newStatus){
        return $this->userDao->updateActiveStatus($userId , $newStatus);
    }

    public function getById($id){
        return $this->userDao->getById($id);
    }

}
