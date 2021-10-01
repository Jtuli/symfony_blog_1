<?php

namespace App\Repository;

use App\Entity\Item;
use App\Entity\ItemSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query as ORMQuery;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    /**
     * Undocumented function
     *
     * @return ORMQuery
     */
    public function findAllVisibleQuery(ItemSearch $search): ORMQuery
    {
        $query = $this->findVisibleQuery();

        /*if ($search->getTag()){
            $query = $query
                ->andWhere(':tag MEMBER OF i.tags')
                ->setParameter('tag', $search->getTag());
        dump($search->getTag());        
        }*/

        if($search->getTag()->count()> 0) {
            $k = 0;
            foreach($search->getTag() as $tag) {
                $k++;
                $query = $query
                        ->andWhere(":tag$k MEMBER OF i.tags")
                        ->setParameter("tag$k", $tag);
            }
        }
        return $query->getQuery();
    }


    /**
     * Undocumented function
     *
     * @return Item[]
     */
    public function findLimitedQuery() {
  
        return $this->findVisibleQuery()
                    ->setMaxResults(8)
                    ->getQuery()
                    ->getResult();


    }


    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('i')
            ->where('i.visible=1');
    }



    // /**
    //  * @return Item[] Returns an array of Item objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Item
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
