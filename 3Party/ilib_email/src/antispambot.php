<?php
if (!function_exists('antispambot')) {
    /**
     * This function is dynamically redefinable.
     */
    function antispambot($args) {
        $args = func_get_args();
        return call_user_func_array($GLOBALS['_global_function_callback_antispambot'], $args);
    }
    if (!isset($GLOBALS['_global_function_callback_antispambot'])) {
        $GLOBALS['_global_function_callback_antispambot'] = 'ilib_antispambot';
    }
}

/**
 * Converts an email to a spam proof e-mail
 *
 * <code>
 * echo antispambot('some@email.php');
 * </code>
 *
 * @param string  $emailaddy The email to convert
 * @param integer $mailto    Whether to add mailto to the returned link
 *
 * @return string Spam encoded email address
 */
function ilib_antispambot($emailaddy, $mailto=0)
{
    $emailNOSPAMaddy = '';
    srand ((float) microtime() * 1000000);
    for ($i = 0; $i < strlen($emailaddy); $i = $i + 1) {
        $j = floor(rand(0, 1+$mailto));
        if ($j==0) {
            $emailNOSPAMaddy .= '&#'.ord(substr($emailaddy,$i,1)).';';
        } elseif ($j==1) {
            $emailNOSPAMaddy .= substr($emailaddy,$i,1);
        } elseif ($j==2) {
            $emailNOSPAMaddy .= '%'.zeroise(dechex(ord(substr($emailaddy, $i, 1))), 2);
        }
    }
    $emailNOSPAMaddy = str_replace('@','&#64;',$emailNOSPAMaddy);
    return $emailNOSPAMaddy;
}
