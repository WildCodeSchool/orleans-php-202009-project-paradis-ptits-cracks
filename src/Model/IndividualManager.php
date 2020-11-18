<?php

namespace App\Model;

class IndividualManager extends AbstractManager
{

    private const TABLE = 'dog';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectDogById(int $id)
    {
        $query = "SELECT d.*, g.label, g.gender, c.dog_color, ac.category, ac.label, s.dog_status FROM dog d
                                            JOIN gender g ON g.id=d.gender_id
                                            JOIN color c ON c.id=d.color_id
                                            JOIN age_category ac ON ac.id=d.age_category_id
                                            JOIN status s ON s.id=d.status_id
                                            WHERE d.id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch();
    }

    public function selectDogPictureByID(int $id)
    {
        $query = "SELECT picture FROM dog WHERE id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch();
    }
}
