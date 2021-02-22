<?php

class UserDAO
{

    private $connection;

    public function __construct()
    {
        require_once 'Connection.php';
        $this->connection = Connection::getConnection();
    }

    public function create(UserDTO $dto)
    {
        $sql = 'INSERT INTO users (user_name, user_password) VALUES (:user_name, :user_password)';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':user_name' => $dto->getName(),
            ':user_password' => $dto->getPassword()
        ));
        return $statement->rowCount() >= 1;
    }

    public function read()
    {
        $sql = 'SELECT user_id AS id, user_name AS name FROM users';
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
        $sql = 'SELECT user_id AS id, user_name AS name FROM users WHERE user_id = :user_id';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':user_id' => $id
        ));
        return $statement->fetchAll();
    }

    public function readByName($name)
    {
        $sql = 'SELECT user_id AS id, user_name AS name, user_password AS password FROM users WHERE user_name = :user_name';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':user_name' => $name
        ));
        return $statement->fetchAll();
    }

    public function update(UserDTO $dto)
    {
        $args = array(
            ':user_id' => $dto->getId(),
            ':user_name' => $dto->getName(),
            ':user_password' => $dto->getPassword()
        );
        $query = Query::createUpdateFromArray('users', $args, 'user_id');
        $statement = $this->connection->prepare($query->getSql());
        $statement->execute($query->getArgs());
        return $statement->rowCount() >= 1; 
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM users WHERE user_id = :user_id';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':user_id' => $id
        ));
        return $statement->rowCount() >= 1;
    }
}
