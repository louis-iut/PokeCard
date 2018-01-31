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
            $userEntityList[$userData['id']] = new User($userData['id'], $userData['facebook_id'], $userData['pseudo']);
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

        if (empty($userData)) {
            return null;
        }

        return $userData[0];
    }


    public function getByFacebookId($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('User', 'u')
            ->where('facebook_id = ?')
            ->setParameter(0, $id)
            ->setMaxResults(1);
        $statement = $queryBuilder->execute();
        $userData = $statement->fetchAll();

        if (empty($userData)) {
            return null;
        }

        return $userData[0];
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

    public function insertUser($facebookId, $pseudo)
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

        return $this->getById($this->db->lastInsertId());
    }

    public function getPokemons($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('*')
            ->from('User_Pokemon_Association')
            ->where('user_id = :user_id')
            ->setParameter(':user_id', $parameters);
        $statement = $queryBuilder->execute();
        $data = $statement->fetchAll();

        return $data;
    }

    public function insertPokemon($userID, $parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->insert('User_Pokemon_Association')
            ->values(
                array(
                    'user_id' => ':userID',
                    'pokemon_id' => ':pokemonID',
                )
            )
            ->setParameter(':userID', $userID)
            ->setParameter(':pokemonID', $parameters);
        $statement = $queryBuilder->execute();
    }

    public function removePokemon($user_id, $pokemon_id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->delete('User_Pokemon_Association')
            ->from('User_Pokemon_Association')
            ->where('user_id = :user_id')
            ->andWhere('pokemon_id = :pokemon_id')
            ->setParameter(':user_id', $user_id)
            ->setParameter(':pokemon_id', $pokemon_id)
            ->setMaxResults(1);
        $statement = $queryBuilder->execute();
    }
}
