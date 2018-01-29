<?php

namespace App\Repository;

use App\Entity\Exchange;
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


    public function insert($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->insert('exchange')
            ->values(
                array(
                    'userID' => ':userID',
                    'firstPokemonID' => ':firstPokemonID',
                    'secondPokemonID' => ':secondPokemonID',
                    'date' => ':date'
                )
            )
            ->setParameter(':userID', $parameters['userID'])
            ->setParameter(':firstPokemonID', $parameters['firstPokemonID'])
            ->setParameter(':secondPokemonID', $parameters['secondPokemonID'])
            ->setParameter(':date', date('Y-m-d H:i:s', time()));
        $statement = $queryBuilder->execute();
    }


    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->delete('exchange')
            ->where('id = :id')
            ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }
}