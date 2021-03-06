<?php

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

use PDOStatement;

/**
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
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
     *
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @return array
     */
    public function selectAllDogData(): array
    {
        return $this->pdo->query("SELECT d.id, d.name, d.picture, d.birthday, d.description, 
            d.link_chiendefrance, d.lof_number, d.is_dna_tested, d.gender_id, d.color_id, d.color_id, d.age_category_id,
            d.status_id, d.mother_id, d.father_id, d.isOnHomepage, g.gender, c.dog_color, s.dog_status, 
            m.name AS mothername, f.name AS fathername, ac.category FROM dog d
            LEFT JOIN gender g ON g.id = d.gender_id
            LEFT JOIN status s ON s.id = d.status_id
            LEFT JOIN dog m ON m.id = d.mother_id
            LEFT JOIN dog f ON f.id = d.father_id
            LEFT JOIN color c ON c.id = d.color_id
            LEFT JOIN age_category ac ON ac.id = d.age_category_id
            ORDER BY d.id DESC
            ")->fetchAll();
    }

    /**
     * @param int $id
     * @return array
     */
    public function selectDogDataById(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT d.id, d.name, d.picture, d.birthday, d.description, 
            d.link_chiendefrance, d.lof_number, d.is_dna_tested, d.gender_id, d.color_id, d.color_id, d.age_category_id,
            d.status_id, d.mother_id, d.father_id, d.isOnHomepage, g.gender, c.dog_color, s.dog_status, 
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

    /**
     * @param string $type
     * @return array
     */
    public function selectAllAdultType(string $type): array
    {
        return $this->pdo->query("SELECT d.id, d.name, d.picture, d.birthday, d.description, 
            d.link_chiendefrance, d.lof_number, d.is_dna_tested, d.gender_id, d.color_id, d.color_id, d.age_category_id,
            d.status_id, d.mother_id, d.father_id, d.isOnHomepage, s.dog_status FROM dog d
            LEFT JOIN gender ON gender.id = d.gender_id
            LEFT JOIN age_category ON age_category.id = d.age_category_id
            LEFT JOIN status s ON s.id = d.status_id
            WHERE gender.label = '$type'
            AND age_category.label = 'adult'
            ORDER BY d.id DESC")->fetchAll();
    }

    /**
     * @return array
     */
    public function selectAllPuppies(): array
    {
        return $this->pdo->query("SELECT d.id, d.name, d.picture, d.birthday, d.description, 
            d.link_chiendefrance, d.lof_number, d.is_dna_tested, d.gender_id, d.color_id, d.color_id, d.age_category_id,
            d.status_id, d.mother_id, d.father_id, d.isOnHomepage, s.dog_status FROM dog d
            LEFT JOIN gender ON gender.id = d.gender_id
            LEFT JOIN age_category ON age_category.id = d.age_category_id
            LEFT JOIN status s ON s.id = d.status_id
            WHERE age_category.label = 'puppies'
            ORDER BY d.id DESC")->fetchAll();
    }

    /**
     * @param int $limit
     * @return array
     */
    public function selectLastPuppies(int $limit): array
    {
        $statement = $this->pdo->prepare("SELECT d.id, d.name, d.picture, d.birthday, g.gender 
            FROM " . self::TABLE . " d 
            LEFT JOIN gender g ON g.id = d.gender_id
            LEFT JOIN age_category ac ON ac.id = d.age_category_id
            WHERE ac.label = 'puppies'
            ORDER BY d.id DESC
            LIMIT :limit");
        $statement->bindValue('limit', $limit, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * @param int $limit
     * @return array
     */
    public function selectHomeDogs(int $limit): array
    {
        $statement = $this->pdo->prepare("SELECT d.id, d.name, d.picture, d.birthday, g.gender 
            FROM " . self::TABLE . " d 
            LEFT JOIN gender g ON g.id = d.gender_id
            LEFT JOIN age_category ac ON ac.id = d.age_category_id
            WHERE d.isOnHomePage = 1
            ORDER BY d.id DESC
            LIMIT :limit");
        $statement->bindValue('limit', $limit, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * @param int $limit
     * @return array
     */
    public function selectLastDogs(int $limit): array
    {
        $statement = $this->pdo->prepare("SELECT d.id, d.name, d.picture, d.birthday, s.dog_status, g.gender 
            FROM " . self::TABLE . " d 
            LEFT JOIN gender g ON g.id = d.gender_id
            LEFT JOIN age_category ac ON ac.id = d.age_category_id
            LEFT JOIN status s ON s.id = d.status_id
            ORDER BY d.id DESC
            LIMIT :limit");
        $statement->bindValue('limit', $limit, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * @param array $dog
     * @return void
     */
    public function saveDog(array $dog): void
    {
        $statement = $this->pdo->prepare("INSERT INTO dog
        (name, picture, birthday, description, link_chiendefrance, lof_number, is_dna_tested, gender_id, color_id, 
        age_category_id, status_id, mother_id, father_id, isOnHomepage)
        VALUES (:name, :picture, :birthday, :description, :link_chiendefrance, :lof_number, :is_dna_tested, :gender_id, 
        :color_id, :age_category_id, :status_id, :mother_id, :father_id, :isOnHomepage)");
        $this->bindDogValues($statement, $dog);
        $statement->execute();
    }

    /**
     * @param array $dog
     * @param int $id
     */
    public function editDog(array $dog, int $id): void
    {
        $statement = $this->pdo->prepare("UPDATE dog SET name=:name, picture=:picture, birthday=:birthday, 
        description=:description, link_chiendefrance=:link_chiendefrance, lof_number=:lof_number, color_id=:color_id,
        is_dna_tested=:is_dna_tested, gender_id=:gender_id, age_category_id=:age_category_id, status_id=:status_id,
        mother_id=:mother_id, father_id=:father_id, isOnHomepage=:isOnHomepage
        WHERE id=:id");
        $this->bindDogValues($statement, $dog);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * @param PDOStatement $statement
     * @param array $dog
     * @return void
     */
    private function bindDogValues(PDOStatement $statement, array $dog): void
    {
        empty($dog['mother_id']) ? $dog['mother_id'] = null : $dog['mother_id'];
        empty($dog['father_id']) ? $dog['father_id'] = null : $dog['father_id'];
        empty($dog['isOnHomepage']) ? $dog['isOnHomepage'] = 0 : $dog['isOnHomepage'];
        $statement->bindValue('name', $dog['name'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $dog['picture'], \PDO::PARAM_STR);
        $statement->bindValue('birthday', $dog['birthday']);
        $statement->bindValue('description', $dog['description'] ?? null, \PDO::PARAM_STR);
        $statement->bindValue('link_chiendefrance', $dog['link_chiendefrance'] ?? null, \PDO::PARAM_STR);
        $statement->bindValue('lof_number', $dog['lof_number'] ?? null, \PDO::PARAM_STR);
        $statement->bindValue('is_dna_tested', $dog['is_dna_tested'] ?? null, \PDO::PARAM_INT);
        $statement->bindValue('gender_id', $dog['gender_id'], \PDO::PARAM_INT);
        $statement->bindValue('color_id', $dog['color_id'], \PDO::PARAM_INT);
        $statement->bindValue('age_category_id', $dog['age_category_id'], \PDO::PARAM_INT);
        $statement->bindValue('status_id', $dog['status_id'], \PDO::PARAM_INT);
        $statement->bindValue('mother_id', $dog['mother_id'], \PDO::PARAM_INT);
        $statement->bindValue('father_id', $dog['father_id'], \PDO::PARAM_INT);
        $statement->bindValue('isOnHomepage', $dog['isOnHomepage'], \PDO::PARAM_INT);
    }

    /**
     * Used in show to display or not the delete button (if a dog has puppies, not possible to delete it)
     * @param int $id
     * @return array
     */
    public function howManyPuppies(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT count(*) children FROM dog 
        WHERE father_id=:id OR mother_id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    /**
     * @param int $id
     */
    public function deleteDog(int $id)
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
