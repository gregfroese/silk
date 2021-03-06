<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * This file is part of the PEAR Console_CommandLine package.
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to the MIT license that is available
 * through the world-wide-web at the following URI:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category  Console 
 * @package   Console_CommandLine
 * @author    David JEAN LOUIS <izimobil@gmail.com>
 * @copyright 2007 David JEAN LOUIS
 * @license   http://opensource.org/licenses/mit-license.php MIT License 
 * @version   CVS: $Id: Exception.php,v 1.5 2008/10/09 10:44:53 izi Exp $
 * @link      http://pear.php.net/package/Console_CommandLine
 * @since     File available since release 0.1.0
 * @filesource
 */

/**
 * Include the PEAR_Exception class
 */
require_once 'PEAR/Exception.php';

/**
 * Class for exceptions raised by the Console_CommandLine package.
 *
 * @category  Console
 * @package   Console_CommandLine
 * @author    David JEAN LOUIS <izimobil@gmail.com>
 * @copyright 2007 David JEAN LOUIS
 * @license   http://opensource.org/licenses/mit-license.php MIT License 
 * @version   Release: 1.0.6
 * @link      http://pear.php.net/package/Console_CommandLine
 * @since     Class available since release 0.1.0
 */
class Console_CommandLine_Exception extends PEAR_Exception
{
    // Codes constants {{{

    /**#@+
     * Exception code constants.
     */
    const OPTION_VALUE_REQUIRED   = 1;
    const OPTION_VALUE_UNEXPECTED = 2;
    const OPTION_VALUE_TYPE_ERROR = 3;
    const OPTION_UNKNOWN          = 4;
    const ARGUMENT_REQUIRED       = 5;
    /**#@-*/

    // }}}
    // factory() {{{

    /**
     * Convenience method that builds the exception with the array of params by 
     * calling the message provider class.
     *
     * @param string              $code   The string identifier of the exception
     * @param array               $params Array of template vars/values
     * @param Console_CommandLine $parser An instance of the parser
     *
     * @return object an instance of Console_CommandLine_Exception
     */
    public static function factory($code, $params, $parser)
    {
        $msg   = $parser->message_provider->get($code, $params);
        $const = 'Console_CommandLine_Exception::' . $code;
        $code  = defined($const) ? constant($const) : 0;
        return new Console_CommandLine_Exception($msg, $code);
    }

    // }}}
}
