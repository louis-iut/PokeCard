<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\DBAL\Connection;

/**
 * User repository.
 */
class UserRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }


    public function getAll()
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('User', 'u');

        $statement = $queryBuilder->execute();
        $usersData = $statement->fetchAll();
        $userEntityList = array();
        foreach ($usersData as $userData) {
            $userEntityList[$userData['id']] = new User($userData['id'], $userData['firstname'], $userData['lastname'], $userData['email'], $userData['pseudo']);
        }

        return $usersData;
    }


    public function getById($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('User', 'u')
            ->where('id = ?')
            ->setParameter(0, $id);
        $statement = $queryBuilder->execute();
        $userData = $statement->fetchAll();

        /*if(!empty($userData)) {
            return new User($userData[0]['id'], $userData[0]['$firstName'], $userData[0]['$lastName'], $userData[0]['$email'], $userData[0]['$pseudo']);
        }*/

        return $userData;
    }

    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->delete('User')
            ->where('id = :id')
            ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }

    public function insert($facebookId, $pseudo)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->insert('User')
            ->values(
                array(
                    'facebook_id' => ':facebook_id',
                    'pseudo' => ':pseudo',
                )
            )
            ->setParameter(':facebook_id', $facebookId)
            ->setParameter(':pseudo', $pseudo);
        $statement = $queryBuilder->execute();

        return $this->db->lastInsertId();
    }
}

