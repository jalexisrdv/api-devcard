<?php

class CategoryDAO
{

    private $connection;

    public function __construct()
    {
        require_once 'Connection.php';
        $this->connection = Connection::getConnection();
    }

    public function create(CategoryDTO $dto)
    {
        $sql = 'INSERT INTO categories (category_name) VALUES (:category_name)';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':category_name' => $dto->getName(),
        ));
        return $statement->rowCount() >= 1;
    }

    public function read()
    {
        $sql = 'SELECT category_id AS id, category_name AS name FROM categories';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $widgets = array();
        foreach ($result as $widget) {
            $widgets[] = $widget;
        }
        return $widgets;
    }

    public function readById($id)
    {
        $sql = 'SELECT category_id AS id, category_name AS name FROM categories WHERE category_id = :category_id';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':category_id' => $id
        ));
        return $statement->fetchAll();
    }

    public function update(CategoryDTO $dto)
    {
        $args = array(
            ':category_id' => $dto->getId(),
            ':category_name' => $dto->getName()
        );
        $query = Query::createUpdateFromArray('categories', $args, 'category_id');
        $statement = $this->connection->prepare($query->getSql());
        $statement->execute($query->getArgs());
        return $statement->rowCount() >= 1;
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM categories WHERE category_id = :category_id';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':category_id' => $id
        ));
        return $statement->rowCount() >= 1;
    }
}
