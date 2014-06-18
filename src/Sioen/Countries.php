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
        if(!isset($this->countries[$language]))
        {
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
        if (strpos('/vendor/', dirname(__FILE__)) !== false) {
            $path .= '../../../';
        }

        // our files with countries are placed in the country-list vendor
        return $path . 'vendor/umpirsky/country-list/country/icu/' .
            $language . '/country.php'
        ;
    }

    /**
     * @param string $language
     * @return array
     */
    public function getForLanguage($language)
    {
        return $this->getCountries($language);
    }
}
