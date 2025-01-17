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
        $stmt = $this->connection->prepare("INSERT INTO users (name,email,password, image , role_id) VALUES( :name , :email , :password, :image , :role_id)");
        $stmt->execute([
            "name" => $user->getName(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "image" => $user->getImage(),
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
            image : $userData["image"],
            password: $userData["password"],
            role: $role
        );
    }

    public function getAllByRoleId($roleId) : array
    {
        $query = "SELECT * FROM users WHERE role_id = :role_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
        $stmt->execute();
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = array() ;

        foreach($results as $result){

            $user = new User(
                $result["id"],
                $result["name"],
                $result["email"],
                $result["password"],
                $result["image"]

            );

            array_push($users , $user);
        }

        return $users;

    }

    public function get3UserByRoleId($roleId) : array
    {
        $query = "SELECT * FROM users WHERE role_id = :role_id ORDER BY id DESC LIMIT 3";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
        $stmt->execute();
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = array() ;

        foreach($results as $result){

            $user = new User(
                $result["id"],
                $result["name"],
                $result["email"],
                $result["password"],
                $result["image"]   
            );

            array_push($users , $user);
        }

        return $users;

    }

}


