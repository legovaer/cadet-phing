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

require_once 'Generate.php';
require_once 'phing/Task.php';

/**
 * Provides a phing task that generates a random string
 */
class GenerateTask extends Task
{
    /**
     * @var string
     */
    private $_name;

    /**
     * @var int
     */
    private $_length = 16;

    /**
     * @var string
     */
    private $_stringType = 'lowercase_uppercase_numeric';

    /**
     * @var array
     */
    private $_acceptedTypes = array(
        'lowercase_upppercase',
        'lowercase',
        'uppercase',
        'lowercase_uppercase_numeric',
        'lowercase_numeric',
        'uppercase_numeric',
        'numeric'
    );

    /**
     * Generates a random string and sets the property name
     */
    public function main()
    {
        $string = Generate::randomString($this->getStringType(), $this->getLength());

        $this->project->setUserProperty($this->getName(), $string);
    }

    public function getRandomString()
    {
        $this->main();
        return $this->project->getUserProperty($this->getName());
    }

    public function getLength()
    {
        return $this->_length;
    }

    public function setLength($length)
    {
        if (!is_numeric($length))
        {
            throw new BuildException('The length must be numeric');
        }

        $this->_length = $length;
    }

    public function getStringType()
    {
        return $this->_stringType;
    }

    public function setStringType($stringType)
    {
        if (!in_array($stringType, $this->_acceptedTypes))
        {
            throw new BuildException(
                sprintf(
                    'The String Type: %s Is Invalid. Accepted Types Are: %s ',
                    $stringType,
                    implode($this->_acceptedTypes)
                )
            );
        }

        $this->_stringType = $stringType;
    }

    /**
     * @return string
     *
     * @throws BuildException
     */
    public function getName()
    {
        if (empty($this->_name))
        {
            throw new BuildException('The name must provided for the property name');
        }

        return $this->_name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }
}
