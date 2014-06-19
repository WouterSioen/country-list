<?php

namespace Sioen;

/**
 * Get a translated list of countries
 * Uses this vendor: https://github.com/umpirsky/country-list/
 *
 * @author Wouter Sioen <wouter.sioen@wijs.be>
 */
class Countries
{
    /**
     * @var array
     */
    protected $countries = array();

    /**
     * @param string $language
     * @return array
     */
    protected function getCountries($language)
    {
        if (!isset($this->countries[$language])) {
            $this->countries[$language] = include($this->getFilePath($language));
        }

        return $this->countries[$language];
    }

    /**
     * @param string $language
     * @return string
     */
    protected function getFilePath($language)
    {
        $path = dirname(__FILE__) . '/../../';

        // if our class is loaded from composer, the path to umpirski changes
        if (strpos(dirname(__FILE__), '/vendor/') !== false) {
            $path .= '../../../';
        }

        // our files with countries are placed in the country-list vendor
        $path .= 'vendor/umpirsky/country-list/country/icu/' .
            $language . '/country.php'
        ;

        if (!is_file($path)) {
            throw new \InvalidArgumentException('Invalid language');
        }

        return $path;
    }

    /**
     * @param string $language
     * @return array
     */
    public function getForLanguage($language)
    {
        return $this->getCountries($language);
    }

    /**
     * @param string $abbreviation
     * @param string $language
     * @return string
     */
    public function getSpecificForLanguage($abbreviation, $language)
    {
        $countries = $this->getCountries($language);

        if (isset($countries[strtoupper($abbreviation)])) {
            return $countries[strtoupper($abbreviation)];
        }

        throw new \InvalidArgumentException('Invalid country abbreviation');
    }
}
