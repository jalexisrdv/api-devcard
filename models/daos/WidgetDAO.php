<?php

class WidgetDAO
{

    private $connection;

    public function __construct()
    {
        require_once 'Connection.php';
        $this->connection = Connection::getConnection();
    }

    public function create(WidgetDTO $dto)
    {
        $sql = 'INSERT INTO widgets (widget_title, widget_content) VALUES (:widget_title, :widget_content)';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':widget_title' => $dto->getTitle(),
            ':widget_content' => $dto->getContent()
        ));
        return $statement->rowCount() >= 1;
    }

    public function read()
    {
        $sql = 'SELECT widget_id AS id, widget_title AS title, widget_content AS content FROM widgets';
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
        $sql = 'SELECT widget_id AS id, widget_title AS title, widget_content AS content from widgets WHERE widget_id = :id';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':id' => $id
        ));
        return $statement->fetchAll();
    }

    public function update(WidgetDTO $dto)
    {
        $args = array(
            ':widget_id' => $dto->getId(),
            ':widget_title' => $dto->getTitle(),
            ':widget_content' => $dto->getContent()
        );
        $query = Query::createUpdateFromArray('widgets', $args, 'widget_id');
        $statement = $this->connection->prepare($query->getSql());
        $statement->execute($query->getArgs());
        return $statement->rowCount() >= 1;
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM widgets WHERE widget_id = :widget_id';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':widget_id' => $id
        ));
        return $statement->rowCount() >= 1;
    }
}
