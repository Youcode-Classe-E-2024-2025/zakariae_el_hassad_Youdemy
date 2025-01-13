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
        $role = new Role(1);

        $user = new User(
            name: $data["name"],
            email: $data["email"],
            password: $hashedPassword,
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
                "message" => "user not found"
            ];
        }   

        if (!password_verify($data["password"], $user->getPassword())) {
            return [
                "logged" => false,
                "message" => "password is incorrect"
            ];
        }
        return [
            "logged" => true,
            "message" => "user logged in successfully",
            "user" => $user
        ];
    }
    public function getAllByRoleId($roleId)
    {
        return $this->userDao->getAllByRoleId($roleId);
    }

}
