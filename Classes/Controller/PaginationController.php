<?php

declare(strict_types=1);

namespace Passionweb\Pagination\Controller;

use GuzzleHttp\Exception\GuzzleException;
use Passionweb\Pagination\Service\PaginationService;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Pagination\ArrayPaginator;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;

class PaginationController extends ActionController
{
    protected $paginationService;
    public function __construct(
        PaginationService $paginationService
    )
    {
        $this->paginationService = $paginationService;
    }

    public function listAction(): ResponseInterface
    {
        // if you have a QueryResultInterface then you must use the QueryResultPaginator
        $sampleData = [
            ['title' => 'First element', 'bodytext' => 'Text of first element.'],
            ['title' => 'Second element', 'bodytext' => 'Text of second element.'],
            ['title' => 'Third element', 'bodytext' => 'Text of third element.'],
            ['title' => 'Fourth element', 'bodytext' => 'Text of fourth element.'],
            ['title' => 'Fifth element', 'bodytext' => 'Text of fifth element.'],
            ['title' => 'Sixth element', 'bodytext' => 'Text of sixth element.'],
            ['title' => 'Seventh element', 'bodytext' => 'Text of seventh element.'],
        ];
        $currentPage = $this->request->hasArgument('currentPage') ? (int)$this->request->getArgument('currentPage') : 1;

        $paginator = new ArrayPaginator($sampleData, $currentPage, 3);

        $simplePagination = new SimplePagination($paginator);
        $pagination = $this->paginationService->buildArrayPagination($simplePagination, $paginator);

        $this->view->assign('sampleData', $sampleData);
        $this->view->assign('paginator', $paginator);
        $this->view->assign('pagination', $pagination);

        return $this->htmlResponse();
    }
}
