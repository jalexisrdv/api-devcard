<?php

class PersonalProjectDAO
{

    private $connection;

    public function __construct()
    {
        require_once 'Connection.php';
        $this->connection = Connection::getConnection();
    }

    public function create(PersonalProjectDTO $dto) {
        $sql = 'INSERT INTO personal_projects (project_title, project_type, project_content) VALUES (:project_title, :project_type, :project_content)';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':project_title' => $dto->getTitle(),
            ':project_type' => $dto->getType(),
            ':project_content' => $dto->getContent()
        ));
        return $statement->rowCount() >= 1;
    }

    public function read() {
        $sql = 'SELECT project_id AS id, project_title AS title, project_type AS type, project_content AS content FROM personal_projects';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $widgets = array();
        foreach ($result as $widget) {
            $widgets[] = $widget;
        }
        return $widgets;
    }

    public function readById($id) {
        $sql = 'SELECT project_id AS id, project_title AS title, project_type AS type, project_content AS content FROM personal_projects WHERE project_id = :project_id';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':project_id' => $id
        ));
        $result = $statement->fetchAll();
        return $result;
    }

    public function update(PersonalProjectDTO $dto) {
        $args = array(
            ':project_id' => $dto->getId(),
            ':project_title' => $dto->getTitle(),
            ':project_type' => $dto->getType(),
            ':project_content' => $dto->getContent()
        );
        $query = Query::createUpdateFromArray('personal_projects', $args, 'project_id');
        $statement = $this->connection->prepare($query->getSql());
        $statement->execute($query->getArgs());
        return $statement->rowCount() >= 1;
    }

    public function delete($id) {
        $sql = 'DELETE FROM personal_projects WHERE project_id = :project_id';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':project_id' => $id
        ));
        return $statement->rowCount() >= 1;
    }
    
}
