<?php

namespace App\Repository;

use App\Entity\Exchange;
use App\Controller\ExchangeController;
use Doctrine\DBAL\Connection;

/**
 * User repository.
 */
class ExchangeRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

   /**
    * Returns a collection of users.
    *
    * @param int $limit
    *   The number of users to return.
    * @param int $offset
    *   The number of users to skip.
    * @param array $orderBy
    *   Optionally, the order by info, in the $column => $direction format.
    *
    * @return array A collection of users, keyed by user id.
    */
    
   public function getAll()
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('e.*')
           ->from('exchange', 'e');

       $statement = $queryBuilder->execute();
       $exchangesData = $statement->fetchAll();
       $exchangeEntityList = array();

       foreach ($exchangesData as $exchangeData) {
          $newExchange = new Exchange($exchangeData['id'], $exchangeData['userID'], $exchangeData['firstPokemonID'], $exchangeData['secondPokemonID'], $exchangeData['date']);
          $exchangeEntityList[] = $newExchange->toArray();
       }

       return $exchangeEntityList;
   }


   public function getById($id)
  {
    $queryBuilder = $this->db->createQueryBuilder();
    $queryBuilder
      ->select('e.*')
      ->from('exchange', 'e')
      ->where('id = ?')
      ->setParameter(0, $id);
      $statement = $queryBuilder->execute();
      $exchangeData = $statement->fetchAll();

      return new Exchange($exchangeData[0]['id'], $exchangeData[0]['userID'], $exchangeData[0]['firstPokemonID'], $exchangeData[0]['secondPokemonID'], $exchangeData[0]['date']);
   }



}