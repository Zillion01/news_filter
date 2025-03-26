<?php

namespace GeorgRinger\NewsFilter\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

class CategoryRepository extends \GeorgRinger\News\Domain\Repository\CategoryRepository
{
    /**
     * Find categories by a given pid
     *
     * @param array $idList
     * @param array $ordering
     * @param $startingPoint
     * @return QueryResultInterface
     * @throws InvalidQueryException
     */
    public function findByIdListWithLanguageSupport(array $idList, array $ordering = [], $startingPoint = null)
    {
        if (empty($idList)) {
            throw new \InvalidArgumentException('The given id list is empty.', 1484823597);
        }
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->getQuerySettings()->setRespectSysLanguage(true);

        if (count($ordering) > 0) {
            $query->setOrderings($ordering);
        }
        $this->overlayTranslatedCategoryIds($idList);

        $conditions = [];
        $conditions[] = $query->in('uid', $idList);

        if (is_null($startingPoint) === false) {
            $conditions[] = $query->in('pid', GeneralUtility::trimExplode(',', $startingPoint, true));
        }

        return $query->matching(
            $query->logicalAnd(
                ...$conditions
            )
        )->execute();
    }
}
