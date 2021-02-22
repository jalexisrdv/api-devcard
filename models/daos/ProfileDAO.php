<?php

class ProfileDAO {

    private $connection;

    public function __construct()
    {
        require_once 'Connection.php';
        $this->connection = Connection::getConnection();
    }

    public function create(ProfileDTO $dto)
    {
        $sql = 'INSERT INTO profiles (profile_first_name, profile_second_name, profile_first_surname, profile_second_surname, profile_degree, profile_picture_url, profile_about, profile_phone_number, profile_email, profile_web_site, profile_city) VALUES (:profile_first_name, :profile_second_name, :profile_first_surname, :profile_second_surname, :profile_degree, :profile_picture_url, :profile_about, :profile_phone_number, :profile_email, :profile_web_site, :profile_city)';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':profile_first_name' => $dto->getFirstName(),
            ':profile_second_name' => $dto->getSecondName(),
            ':profile_first_surname' => $dto->getFirstSurname(),
            ':profile_second_surname' => $dto->getSecondSurname(),
            ':profile_degree' => $dto->getDegree(),
            ':profile_picture_url' => $dto->getPictureUrl(),
            ':profile_about' => $dto->getAbout(),
            ':profile_phone_number' => $dto->getPhoneNumber(),
            ':profile_email' => $dto->getEmail(),
            ':profile_web_site' => $dto->getWebSite(),
            ':profile_city' => $dto->getCity()
        ));
        return $statement->rowCount() >= 1;
    }

    public function read()
    {
        $sql = 'SELECT profile_id AS id, profile_first_name AS firstName, profile_second_name AS secondName, profile_first_surname AS firstSurname, profile_second_surname AS secondSurname, profile_degree AS degree, profile_picture_url AS pictureUrl, profile_about AS about, profile_phone_number AS phoneNumber, profile_email AS email, profile_web_site AS webSite, profile_city AS city FROM profiles';
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
        $sql = 'SELECT profile_id AS id, profile_first_name AS firstName, profile_second_name AS secondName, profile_first_surname AS firstSurname, profile_second_surname AS secondSurname, profile_degree AS degree, profile_picture_url AS pictureUrl, profile_about AS about, profile_phone_number AS phoneNumber, profile_email AS email, profile_web_site AS webSite, profile_city AS city FROM profiles WHERE profile_id = :profile_id';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':profile_id' => $id
        ));
        return $statement->fetchAll();
    }

    public function update(ProfileDTO $dto)
    {
        $args = array(
            ':profile_id' => $dto->getId(),
            ':profile_first_name' => $dto->getFirstName(),
            ':profile_second_name' => $dto->getSecondName(),
            ':profile_first_surname' => $dto->getFirstSurname(),
            ':profile_second_surname' => $dto->getSecondSurname(),
            ':profile_degree' => $dto->getDegree(),
            ':profile_picture_url' => $dto->getPictureUrl(),
            ':profile_about' => $dto->getAbout(),
            ':profile_phone_number' => $dto->getPhoneNumber(),
            ':profile_email' => $dto->getEmail(),
            ':profile_web_site' => $dto->getWebSite(),
            ':profile_city' => $dto->getCity()
        );
        $query = Query::createUpdateFromArray('profiles', $args, 'profile_id');
        $statement = $this->connection->prepare($query->getSql());
        $statement->execute($query->getArgs());
        return $statement->rowCount() >= 1;
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM profiles WHERE profile_id = :profile_id';
        $statement = $this->connection->prepare($sql);
        $statement->execute(array(
            ':profile_id' => $id
        ));
        return $statement->rowCount() >= 1;
    }

}