<?php

class WorkExperienceDAO {

    private $connection;

    public function __construct()
    {
        require_once 'Connection.php';
        $this->connection = Connection::getConnection(); 
    }

    public function create(WorkExperienceDTO $dto) {
        $sql = 'INSERT INTO work_experiences (work_title, work_company, work_start_year, work_end_year, work_content) VALUES (:work_title, :work_company, :work_start_year, :work_end_year, :work_content)';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':work_title' => $dto->getTitle(),
            ':work_company' => $dto->getCompany(),
            ':work_start_year' => $dto->getStartYear(),
            ':work_end_year' => $dto->getEndYear(),
            ':work_content' => $dto->getContent()
        ));
        return $statement->rowCount() >= 1;
    }

    public function read() {
        $sql = 'SELECT work_id AS id, work_title AS title, work_company AS company, work_start_year AS startYear, work_end_year AS endYear, work_content AS content FROM work_experiences';
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
        $sql = 'SELECT work_id AS id, work_title AS title, work_company AS company, work_start_year AS startYear, work_end_year AS endYear, work_content AS content FROM work_experiences WHERE work_id = :work_id';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':work_id' => $id
        ));
        return $statement->fetchAll();
    }

    public function update(WorkExperienceDTO $dto) {
        $args = array(
            ':work_id' => $dto->getId(),
            ':work_title' => $dto->getTitle(),
            ':work_company' => $dto->getCompany(),
            ':work_start_year' => $dto->getStartYear(),
            ':work_end_year' => $dto->getEndYear(),
            ':work_content' => $dto->getContent()
        );
        $query = Query::createUpdateFromArray('work_experiences', $args, 'work_id');
        $statement = $this->connection->prepare($query->getSql());
        $statement->execute($query->getArgs());
        return $statement->rowCount() >= 1;
    }

    public function delete($id) {
        $sql = 'DELETE FROM work_experiences WHERE work_id = :work_id';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':work_id' => $id
        ));
        return $statement->rowCount() >= 1;
    }

}