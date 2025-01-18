<?php

abstract class BaseDao
{
    protected PDO $connection;
    protected readonly string $tableName;
    protected readonly array $columns;

    protected function __construct(string $tableName)
    {
        $connectionHolder = new DatabaseConnection;
        $this->connection = $connectionHolder->connect();
        $this->tableName = $tableName;
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

































    public function getAll(){

        $columns = implode("," , $this->columns);

        $stmt = $this->connection->query("SELECT ($columns) FROM $this->tableName ");


    }
}
