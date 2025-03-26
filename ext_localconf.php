<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['Domain/Repository/AbstractDemandedRepository.php']['findDemanded']['news_filter']
    = \GeorgRinger\NewsFilter\Hooks\Repository::class . '->modify';

$vars = \GeorgRinger\NewsFilter\Utility\DeprecatedUtility::_POST('tx_news_pi1');
if (isset($vars['search']) && is_array($vars['search'])) {
    foreach (['Pi1', 'NewsListSticky', 'NewsSelectedList'] as $pluginName) {
        $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['extbase']['extensions']['News']['plugins'][$pluginName]['controllers'][\GeorgRinger\News\Controller\NewsController::class]['nonCacheableActions'][] = 'list';
    }
}

$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Domain/Repository/CategoryRepository'][] = 'news_filter';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][\TYPO3\CMS\Core\Configuration\FlexForm\FlexFormTools::class]['flexParsing']['news_filter']
    = \GeorgRinger\NewsFilter\Hooks\FlexFormHook::class;

$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['Controller/NewsController.php']['createDemandObjectFromSettings']['news_filter']
 = \GeorgRinger\NewsFilter\Hooks\EnrichDemandObject::class . '->run';
