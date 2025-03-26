<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'news_filter',
    'Filter',
    'Advanced news filter'
);
$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase('news_filter'));
$pluginSignature = $extensionName . '_filter';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--div--;Configuration,pi_flexform,', $pluginSignature, 'after:subheader');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('*', 'FILE:EXT:news_filter/Configuration/FlexForms/flexform_newsfilter.xml', $pluginSignature);
