<?php

namespace Sioen\Tests;

use Sioen\Countries;

class ConverterTest extends \PHPUnit_Framework_TestCase
{
    function testGetFilePathReturnsPathToAFile()
    {
        $countries = new Countries();
        $method = $this->getPublicMethod('Sioen\Countries', 'getFilePath');

        $filePath = $method->invokeArgs($countries, array('en'));
        $this->assertTrue(is_file($filePath));

        $filePath = $method->invokeArgs($countries, array('nl'));
        $this->assertTrue(is_file($filePath));

        $filePath = $method->invokeArgs($countries, array('de'));
        $this->assertTrue(is_file($filePath));
    }

    /**
     * Returns a public version of a method
     *
     * @param string $class Name of the class
     * @param string $name  Name of the method
     * @return \ReflectionMethod
     */
    protected function getPublicMethod($class, $name)
    {
        $class = new \ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}
