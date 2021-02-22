<?php

class ProjectPostDAO
{

    private $connection;

    public function __construct()
    {
        require_once 'Connection.php';
        $this->connection = Connection::getConnection();
    }

    public function create(ProjectPostDTO $dto)
    {
        $sql = 'INSERT INTO projects_posts (post_title, post_content, post_date, category_id_categories_fk) VALUES (:post_title, :post_content, :post_date, :post_category_id)';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':post_title' => $dto->getTitle(),
            ':post_content' => $dto->getContent(),
            ':post_date' => $dto->getDate(),
            ':post_category_id' => $dto->getCategoryId(),
        ));
        return $statement->rowCount() >= 1;
    }

    public function read()
    {
        $sql = 'SELECT post_id AS id, post_title AS title, post_content AS content, post_date AS date, categories.category_name AS category FROM projects_posts INNER JOIN categories ON categories.category_id = projects_posts.category_id_categories_fk';
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
        $sql = 'SELECT post_id AS id, post_title AS title, post_content AS content, post_date AS date, categories.category_name AS category FROM projects_posts INNER JOIN categories ON categories.category_id = projects_posts.category_id_categories_fk WHERE post_id = :post_id';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':post_id' => $id
        ));
        return $statement->fetchAll();
    }

    public function update(ProjectPostDTO $dto)
    {
        $args = array(
            ':post_id' => $dto->getId(),
            ':post_title' => $dto->getTitle(),
            ':post_content' => $dto->getContent(),
            ':post_date' => $dto->getDate(),
            ':category_id_categories_fk' => $dto->getCategoryId()
        );
        $query = Query::createUpdateFromArray('projects_posts', $args, 'post_id');
        $statement = $this->connection->prepare($query->getSql());
        $statement->execute($query->getArgs());
        return $statement->rowCount() >= 1;
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM projects_posts WHERE post_id = :post_id';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':post_id' => $id
        ));
        return $statement->rowCount() >= 1;
    }
}
