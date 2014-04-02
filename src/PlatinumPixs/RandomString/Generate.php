<?php
/**
 * Copyright 2013 Platinum Pixs, LLC. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 * http://aws.amazon.com/apache2.0
 *
 * or in the "license" file accompanying this file. This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

/**
 * Provides a static utility class to generate the string
 */
class Generate
{
    /**
     * Generates a random string
     *
     * @static
     */
    public static function randomString($type, $length)
    {
        $string = '';

        switch ($type)
        {
            case 'lowercase_upppercase':
                $characters = self::lowercase() . self::uppercase();
                break;
            case 'lowercase':
                $characters = self::lowercase();
                break;
            case 'uppercase':
                $characters = self::uppercase();
                break;
            case 'lowercase_uppercase_numeric':
                $characters = self::lowercase() . self::uppercase() . self::numericRange();
                break;
            case 'lowercase_numeric':
                $characters = self::lowercase() . self::numericRange();
                break;
            case 'uppercase_numeric':
                $characters = self::uppercase() . self::numericRange();
                break;
            default:
                $characters = self::numericRange();
        }

        $charactersLength = strlen($characters) - 1;

        for ($p = 0; $p < $length; $p++)
        {
            $string .= $characters[mt_rand(0, $charactersLength)];
        }

        return $string;
    }

    /**
     * Returns a number 0-9
     *
     * @static
     * @return int
     */
    public static function numericRange()
    {
        $retval = implode('', range(0,9));
        return $retval;
    }

    /**
     * Returns a string a-z
     *
     * @static
     * @return string
     */
    public static function lowercase()
    {
        $retval = implode('', range('a', 'z'));
        return $retval;
    }

    /**
     * Returns a string A-Z
     *
     * @static
     * @return string
     */
    public static function uppercase()
    {
        $retval = strtoupper(self::lowercase());
        return $retval;
    }
}
