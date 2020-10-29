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
class DogManager extends AbstractManager
{
    /**
     *
     */
    private const TABLE = 'dog';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAllAdultMales(): array
    {
        return $this->pdo->query('SELECT * FROM dog WHERE gender_id = 1 AND age_category_id = 2')->fetchAll();
    }

    public function selectAllAdultFemales(): array
    {
        return $this->pdo->query('SELECT * FROM dog WHERE gender_id = 2 AND age_category_id = 2')->fetchAll();
    }

    public function saveDog($dog)
    {
        empty($dog['mother_select']) ? $dog['mother_select'] = null : $dog['mother_select'];
        empty($dog['father_select']) ? $dog['father_select'] = null : $dog['father_select'];

        $statement = $this->pdo->prepare("INSERT INTO dog
        (name, picture, birthday, description, link_chiendefrance, lof_number, is_dna_tested, gender_id, color_id, 
        age_category_id, status_id, mother_id, father_id)
        VALUES (:name, :picture, :birthday, :description, :link_chiendefrance, :lof_number, :is_dna_tested, :gender_id, 
        :color_id, :age_category_id, :status_id, :mother_id, :father_id)");
        $statement->bindValue('name', $dog['name'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $dog['picture'], \PDO::PARAM_STR);
        $statement->bindValue('birthday', $dog['birthday']);
        $statement->bindValue('description', $dog['description'] ?? null, \PDO::PARAM_STR);
        $statement->bindValue('link_chiendefrance', $dog['chien_de_france'] ?? null, \PDO::PARAM_STR);
        $statement->bindValue('lof_number', $dog['lof_number'] ?? null, \PDO::PARAM_STR);
        $statement->bindValue('is_dna_tested', $dog['dna_test'] ?? null, \PDO::PARAM_INT);
        $statement->bindValue('gender_id', $dog['gender'], \PDO::PARAM_INT);
        $statement->bindValue('color_id', $dog['color_select'], \PDO::PARAM_INT);
        $statement->bindValue('age_category_id', $dog['age_category'], \PDO::PARAM_INT);
        $statement->bindValue('status_id', $dog['status_select'], \PDO::PARAM_INT);
        $statement->bindValue('mother_id', $dog['mother_select'], \PDO::PARAM_INT);
        $statement->bindValue('father_id', $dog['father_select'], \PDO::PARAM_INT);
        $statement->execute();
    }
}
