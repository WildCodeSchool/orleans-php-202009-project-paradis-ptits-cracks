<?php

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class ActualityManager extends AbstractManager
{
    private const TABLE = 'actuality';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
    public function saveActuality(array $actuality)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (title, date, description)
     VALUES (:title, :date, :description)");
        $statement->bindValue(':title', $actuality['title'], \PDO::PARAM_STR);
        $statement->bindValue(':date', $actuality['date']);
        $statement->bindValue(':description', $actuality['description'], \PDO::PARAM_STR);
        $statement->execute();
    }

    public function deleteActuality(int $id)
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function editActuality($actuality, $id)
    {
        $statement = $this->pdo->prepare("UPDATE actuality SET title=:title, date=:date,
        description=:description WHERE id=:id");
        $statement->bindValue(':id', $id, \PDO::PARAM_STR);
        $statement->bindValue(':title', $actuality['title'], \PDO::PARAM_STR);
        $statement->bindValue(':date', $actuality['date']);
        $statement->bindValue(':description', $actuality['description'], \PDO::PARAM_STR);

        $statement->execute();
    }

    public function selectLastActualities(int $limit): array
    {
        $statement = $this->pdo->prepare("SELECT id, title, date, description FROM " . self::TABLE . " AS a
            ORDER BY a.id DESC
            LIMIT :limit");
        $statement->bindValue('limit', $limit, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
}
