<?php

namespace GeorgRinger\NewsFilter\Utility;

/**
 * Class DeprecatedUtility
 *
 * This stuf used to be in GeneralUtility < TYPO3 v13
 * For now just to get news_filter working
 *
 * Jacco - 21-03-2025
 */
class DeprecatedUtility
{
    /**
     * Returns the global $_POST array (or value from) normalized to contain un-escaped values.
     *
     * @param string $var Optional pointer to value in POST array (basically name of POST var)
     * @return mixed If $var is set it returns the value of $_POST[$var]. If $var is NULL (default), returns $_POST itself.
     * @see _GET()
     * @see _GP()
     */
    public static function _POST($var = null)
    {
        $value = $var === null ? $_POST : (empty($var) || !isset($_POST[$var]) ? null : $_POST[$var]);
        // This is there for backwards-compatibility, in order to avoid NULL
        if (isset($value) && !is_array($value)) {
            $value = (string)$value;
        }
        return $value;
    }
}
