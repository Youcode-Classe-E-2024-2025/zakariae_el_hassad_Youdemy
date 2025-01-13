<?php

class UserDao
{
    private PDO $connection;

    public function __construct()
    {
        $connectionHolder = new DatabaseConnection();
        $this->connection = $connectionHolder->connect();
    }

    public function create(User $user): int
    {
        $stmt = $this->connection->prepare("INSERT INTO users (name,email,password, role_id) VALUES( :name , :email , :password, :role_id)");
        $stmt->execute([
            "name" => $user->getName(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "role_id" => $user->getRole()->getId()
        ]);
        return $this->connection->lastInsertId();
    }

    public function getByEmail(string $email)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(["email" => $email]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userData) {
            return null;
        }
        

        $role = new Role();
        $role->setId($userData["role_id"]);
        
        return new User(
            id: $userData["id"],
            name: $userData["name"],
            email: $userData["email"],
            password: $userData["password"],
            role: $role
        );
    }

    public function getAllByRoleId($roleId)
    {
        $query = "SELECT * FROM users WHERE role_id = :role_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
