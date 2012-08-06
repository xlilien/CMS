<?php
/**
 * NewsreelRepository
 *
 * @author  Jiří Šifalda
 * @package Flame
 *
 * @date    10.07.12
 */

namespace Flame\CMS\Models\Newsreel;

class NewsreelRepository extends \Flame\Doctrine\Repository
{
	public function findAllPassed($limit)
	{
		$qb = $this->entityManager->createQueryBuilder();
		$q = $qb->select('n')
			->from('\Flame\CMS\Models\Newsreel\Newsreel', 'n')
			->where($qb->expr()->lte('n.date', ':date_from'))
			->orderBy('n.date', 'DESC');

		if($limit){
			$q->setMaxResults((int) $limit);
		}

		return $q->getQuery()
			->setParameters(array('date_from' => new \DateTime()))
			->getResult();
	}
}