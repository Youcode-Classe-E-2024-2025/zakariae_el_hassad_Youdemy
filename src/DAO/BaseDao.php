<?php

abstract class BaseDao
{
    protected PDO $connection;
    protected readonly string $tableName;
    protected readonly array $columns;
    protected readonly string $className;

    protected function __construct(string $tableName , string $className)
    {
        $connectionHolder = new DatabaseConnection;
        $this->connection = $connectionHolder->connect();
        $this->tableName = $tableName;
        $this->className = $className;
        $this->columns = $this->loadColumns();
    }

    private function loadColumns()
    {
        $stmt = $this->connection->query("DESCRIBE $this->tableName");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function create(object $model)
    {
        $columns = implode(",", $this->columns);
        $placeHolders = implode(",", array_map(fn($col) => ":$col", $this->columns));

        $stmt = $this->connection->prepare("INSERT INTO $this->tableName ($columns) VALUES ($placeHolders)");

        $params = [];
        foreach ($this->columns as $col) {
            if (str_ends_with($col, "_id")) {
                $fieldName = substr($col, 0, -3);
                $getter1 = "get" . ucfirst($fieldName);
                $object = $model->$getter1();
                $params[":$col"] = $object->getId();
            }else {   
                $getter = "get" . ucfirst($col);
                if (method_exists($model, $getter)) {
                    $params[":$col"] = $model->$getter();
                }
            }
        }

        $stmt->execute($params);
        return $this->connection->lastInsertId();
    }

    public function delete($id){
    
        $stmt = $this->connection->prepare("DELETE FROM $this->tableName WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getAllEntities(): array {
        $stmt = $this->connection->prepare("SELECT * FROM $this->tableName");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $entities = [];
        
        foreach ($rows as $row) {
            $reflectionClass = new ReflectionClass($this->className);
    
            $constructor = $reflectionClass->getConstructor();
            
            if ($constructor) {
                $params = [];
                foreach ($constructor->getParameters() as $param) {
                    $paramName = $param->getName();
                    if (array_key_exists($paramName, $row)) {
                        $params[] = $row[$paramName]; 
                    } else {
                        $params[] = null; 
                    }
                }
                $entity = $reflectionClass->newInstanceArgs($params);
            } 

            $entities[] = $entity;
        }
        
        return $entities;
    }
}
