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

    public function selectAllDogData(): array
    {
        return $this->pdo->query("SELECT d.*, g.gender, c.dog_color, s.dog_status, m.name AS mothername,
            f.name AS fathername, ac.category FROM dog d
            LEFT JOIN gender g ON g.id = d.gender_id
            LEFT JOIN status s ON s.id = d.status_id
            LEFT JOIN dog m ON m.id = d.mother_id
            LEFT JOIN dog f ON f.id = d.father_id
            LEFT JOIN color c ON c.id = d.color_id
            LEFT JOIN age_category ac ON ac.id = d.age_category_id
            ORDER BY d.id DESC
            ")->fetchAll();
    }

    public function selectDogDataById(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT d.*, g.gender, c.dog_color, s.dog_status, 
            m.name AS mothername, f.name AS fathername, ac.category FROM dog d
            LEFT JOIN gender g ON g.id = d.gender_id
            LEFT JOIN status s ON s.id = d.status_id
            LEFT JOIN dog m ON m.id = d.mother_id
            LEFT JOIN dog f ON f.id = d.father_id
            LEFT JOIN color c ON c.id = d.color_id
            LEFT JOIN age_category ac ON ac.id = d.age_category_id
            WHERE d.id=:id
            ");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
    public function selectAllAdultType(string $type): array
    {
        return $this->pdo->query("SELECT * FROM dog 
            LEFT JOIN gender ON gender.id = dog.gender_id
            LEFT JOIN age_category ON age_category.id = dog.age_category_id
            WHERE gender.label = '$type'
            AND age_category.label = 'adult'")->fetchAll();
    }

    public function selectAllPuppies(): array
    {
        return $this->pdo->query("SELECT * FROM dog 
            LEFT JOIN gender ON gender.id = dog.gender_id
            LEFT JOIN age_category ON age_category.id = dog.age_category_id
            WHERE age_category.label = 'puppies'")->fetchAll();
    }

    public function selectThreePuppies(): array
    {
        return $this->pdo->query("SELECT d.id, d.name, d.picture, d.birthday, g.gender FROM dog d 
            LEFT JOIN gender g ON g.id = d.gender_id
            LEFT JOIN age_category ac ON ac.id = d.age_category_id
            WHERE ac.label = 'puppies'
            ORDER BY d.id DESC
            LIMIT 3")->fetchAll();
    }

    public function saveDog($dog): void
    {
        $statement = $this->pdo->prepare("INSERT INTO dog
        (name, picture, birthday, description, link_chiendefrance, lof_number, is_dna_tested, gender_id, color_id, 
        age_category_id, status_id, mother_id, father_id)
        VALUES (:name, :picture, :birthday, :description, :link_chiendefrance, :lof_number, :is_dna_tested, :gender_id, 
        :color_id, :age_category_id, :status_id, :mother_id, :father_id)");
        $this->bindDogValues($statement, $dog);
        $statement->execute();
    }

    public function editDog($dog, $id): void
    {
        $statement = $this->pdo->prepare("UPDATE dog SET name=:name, picture=:picture, birthday=:birthday, 
        description=:description, link_chiendefrance=:link_chiendefrance, lof_number=:lof_number, color_id=:color_id,
        is_dna_tested=:is_dna_tested, gender_id=:gender_id, age_category_id=:age_category_id, status_id=:status_id,
        mother_id=:mother_id, father_id=:father_id
        WHERE id=:id");
        $this->bindDogValues($statement, $dog);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    private function bindDogValues(\PDOStatement $statement, array $dog): void
    {
        empty($dog['mother_select']) ? $dog['mother_select'] = null : $dog['mother_select'];
        empty($dog['father_select']) ? $dog['father_select'] = null : $dog['father_select'];
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
    }

    public function howManyPuppies(int $id)
    {
        $statement = $this->pdo->prepare("SELECT count(*) children FROM dog 
        WHERE father_id=:id OR mother_id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function deleteDog(int $id)
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
