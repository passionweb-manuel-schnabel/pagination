<?php

declare(strict_types=1);

namespace Passionweb\Pagination\Service;

use TYPO3\CMS\Core\Pagination\ArrayPaginator;
use TYPO3\CMS\Core\Pagination\SimplePagination;

class PaginationService
{
    /**
     * build pagination based on array data
     */
    public function buildArrayPagination(SimplePagination $simplePagination, ArrayPaginator $paginator): array
    {
        $firstPage = $simplePagination->getFirstPageNumber();
        $lastPage = $simplePagination->getLastPageNumber();
        return [
            'lastPageNumber' => $lastPage,
            'firstPageNumber' => $firstPage,
            'nextPageNumber' => $simplePagination->getNextPageNumber(),
            'previousPageNumber' => $simplePagination->getPreviousPageNumber(),
            'currentPageNumber' => $paginator->getCurrentPageNumber(),
            'pages' => range($firstPage, $lastPage)
        ];
    }
}
