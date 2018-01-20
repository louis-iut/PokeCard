<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;

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

   public function getByEmail($email)
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('u.*')
           ->from('User', 'u')
           ->where('email = ?')
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

    public function getPokemons($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->select('*')
          ->from('user_has_pokemons')
          ->where('userID = :userID')
          ->setParameter(':userID', $parameters);
        $statement = $queryBuilder->execute();
        $data = $statement->fetchAll();
        return $data;
    }

    public function insert($userID, $parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->insert('user_has_pokemons')
          ->values(
              array(
                'userID' => ':userID',
                'pokemonID' => ':pokemonID',
              )
          )
          ->setParameter(':userID', $userID)
          ->setParameter(':pokemonID', $parameters);
        $statement = $queryBuilder->execute();
    }
}
