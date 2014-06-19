<?php

namespace Sioen\Tests;

use Sioen\Countries;

class ConverterTest extends \PHPUnit_Framework_TestCase
{
    function testGetFilePathReturnsPathToAFile()
    {
        $countries = new Countries();
        $filePath = $this->invokeProtectedMethod(
            'Sioen\Countries',
            'getFilePath',
            $countries,
            array('en')
        );
        $this->assertTrue(is_file($filePath));

        $filePath = $this->invokeProtectedMethod(
            'Sioen\Countries',
            'getFilePath',
            $countries,
            array('nl')
        );
        $this->assertTrue(is_file($filePath));

        $filePath = $this->invokeProtectedMethod(
            'Sioen\Countries',
            'getFilePath',
            $countries,
            array('de')
        );
        $this->assertTrue(is_file($filePath));
    }

    function testGetFilePathThrowsExceptionIfFileNotfound()
    {
        $countries = new Countries();
        $this->setExpectedException('InvalidArgumentException', 'Invalid language');
        $filePath = $this->invokeProtectedMethod(
            'Sioen\Countries',
            'getFilePath',
            $countries,
            array('qsdfqsdfsqdf')
        );

        $this->setExpectedException('InvalidArgumentException', 'Invalid language');
        $filePath = $this->invokeProtectedMethod(
            'Sioen\Countries',
            'getFilePath',
            $countries,
            array('')
        );
    }

    function testGetSpecificForLanguage()
    {
        $countries = new Countries();

        $this->assertEquals(
            'Belgium',
            $countries->getSpecificForLanguage('be', 'en')
        );
        $this->assertEquals(
            'België',
            $countries->getSpecificForLanguage('be', 'nl')
        );
    }

    function testGetSpecificForLanguageThrowsErrorForInvalidAbbreviation()
    {
        $countries = new Countries();

        $this->setExpectedException('InvalidArgumentException', 'Invalid country abbreviation');
        $countries->getSpecificForLanguage('bsqfdfqsde', 'en');

        $this->setExpectedException('InvalidArgumentException', 'Invalid country abbreviation');
        $countries->getSpecificForLanguage('qsdf', 'en');
    }

    /**
     * Returns a public version of a method
     *
     * @param string $class Name of the class
     * @param string $name  Name of the method
     * @param Class  $instance instance of the class
     * @param array  $arguments The arguments that need to be passed to the method
     * @return mixed
     */
    protected function invokeProtectedMethod($class, $name, $instance, $arguments)
    {
        $class = new \ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($instance, $arguments);;
    }
}
