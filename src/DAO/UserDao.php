<?php

use LDAP\Result;

class UserDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct("users", User::class );
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
        image: $userData["image"],
        role: $role,
        active: $userData["active"] 
    );
}


public function getAllByRoleIds($roleIds): array
{
    $placeholders = rtrim(str_repeat('?, ', count($roleIds)), ', '); 
    
    $query = "SELECT * FROM users WHERE role_id IN ($placeholders)";
    $stmt = $this->connection->prepare($query);
    foreach ($roleIds as $index => $roleId) {
        $stmt->bindValue($index + 1, $roleId, PDO::PARAM_INT);
    }
    
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $users = array();

    foreach ($results as $result) {
        $user = new User(
            $result["id"],
            $result["name"],
            $result["email"],
            $result["password"],
            $result["image"]
        );

        array_push($users, $user);
    }

    return $users;
}


public function getLast3UsersByRoles(): array
{
    $query = "SELECT * FROM users WHERE role_id IN (2, 3) ORDER BY id DESC LIMIT 3";
    $stmt = $this->connection->prepare($query);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $users = [];

    foreach ($results as $result) {
        $user = new User(
            $result["id"],
            $result["name"],
            $result["email"],
            $result["password"],
            $result["image"]
        );

        $users[] = $user; // Add user to array
    }

    return $users;
}



    public function updateActiveStatus(int $userId, int $newStatus)
{
    $stmt = $this->connection->prepare("UPDATE users SET active = :active WHERE id = :id");
    $stmt->execute([
        "active" => $newStatus,
        "id" => $userId
    ]);
}

public function getById(int $id): ?User
{
    $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(["id" => $id]);
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
        image: $userData["image"],
        role: $role,
        active: $userData["active"]
    );
}


}
