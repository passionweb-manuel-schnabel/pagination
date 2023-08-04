<?php

defined('TYPO3') || die('Access denied.');


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Pagination',
    'ExamplePagination',
    [
        \Passionweb\Pagination\Controller\PaginationController::class => 'list'
    ],
    // non-cacheable actions
    [
        \Passionweb\Pagination\Controller\PaginationController::class => 'list'
    ]
);

// wizards
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    'mod {
        wizards.newContentElement.wizardItems.plugins {
            elements {
                examplepagination {
                    iconIdentifier = pagination-example
                    title = LLL:EXT:pagination/Resources/Private/Language/locallang_db.xlf:plugin_pagination_example.name
                    description = LLL:EXT:pagination/Resources/Private/Language/locallang_db.xlf:plugin_pagination_example.description
                    tt_content_defValues {
                        CType = list
                        list_type = pagination_examplepagination
                    }
                }
            }
            show = *
        }
   }'
);

$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
    'pagination-example',
    \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
    ['source' => 'EXT:pagination/Resources/Public/Icons/Extension.png']
);

