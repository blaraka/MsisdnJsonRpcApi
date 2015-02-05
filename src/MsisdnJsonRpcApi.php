<?php
/*
 * JSON-RCP Exposure Module for MsisdnResolver Package.
 * A simple PHP package for interpreting MSISDN numbers. 
 *
 * (c) Mateusz Krasucki 2015
 *
 * License in LICENSE file in root directory of repository.
 */
 
 namespace MateuszKrasucki\MsisdnJsonRpcApi;
 
 require __DIR__ . '/../vendor/autoload.php';
 
 class ApiMethods
 {
 
    public $error = null;

     /**
     * @returns an array with all the properties of the Msisdn object constructed after parsing given string
     */
    public function getAllProperties($msisdnGiven)
    {
        $msisdn = new Msisdn($msisdnGiven);
        return array(
            "msisdnGiven"    => $msisdn->getMsisdnGiven(),
            "msisdn"  => $msisdn->getMsisdn(),
            "nationalNumber"  => $msisdn->getNationalNumber(),
            "countryCode" => $msisdn->getCountryCode(),
            "countryId" => $msisdn->getCountryId(),
            "mno" => $msisdn->getMno(),
        );
    }

    /**
     * @param string $msisdnGiven
     *    
     * @return string in format "MNO, country code, national number, country ISO-2 id
     */
    public function getFulLString($msisdnGiven)
    {
        $msisdn = new Msisdn($msisdnGiven);
        return $msisdn->getFullString();
    }
    
    /**
     * @param string $msisdnGiven
     *    
     * @return processed msisdn string or null if not determined
     */
    public function getMsisdn($msisdnGiven)
    {
        $msisdn = new Msisdn($msisdnGiven);
        return $msisdn->getMsisdn();
    }

    /**
     * @param string $msisdnGiven
     *    
     * @return processed msisdn string or "Unknown" if not determined
     */
    public function getMsisdnString($msisdnGiven)
    {
        $msisdn = new Msisdn($msisdnGiven);
        return $msisdn->getMsisdnString();
    }

    /**
     * @param string $msisdnGiven
     *    
     * @return national number string or null if not determined
     */
    public function getNationalNumber($msisdnGiven)
    {
        $msisdn = new Msisdn($msisdnGiven);
        return $msisdn->getNationalNumber();
    }

    /**
     * @param string $msisdnGiven
     *    
     * @return national number string or "Unknown" if not determined
     */
    public function getNationalNumberString($msisdnGiven)
    {
        $msisdn = new Msisdn($msisdnGiven);
        return $msisdn->getNationalNumberString();
    }

    /**
     * @param string $msisdnGiven
     *    
     * @return country dialing code string or null if not determined
     */
    public function getCountryCode($msisdnGiven)
    {
        $msisdn = new Msisdn($msisdnGiven);
        return $msisdn->getCountryCode();
    }

    /**
     * @param string $msisdnGiven
     *    
     * @return country dialing code string or "Unknown" if not determined
     */
    public function getCountryCodeString($msisdnGiven)
    {
        $msisdn = new Msisdn($msisdnGiven);
        return $msisdn->getCountryCodeString();
    }
    
    /**
     * @param string $msisdnGiven
     *    
     * @return ISO 3166-1 alpha-2 country symbol string or null if not detrmined
     */
    public function getCountryId($msisdnGiven)
    {
        $msisdn = new Msisdn($msisdnGiven);
        return $msisdn->getCountryId();
    }
    
    /**
     * @param string $msisdnGiven
     *    
     * @return ISO 3166-1 alpha-2 country symbol string or "Unknown" if not detrmined
     */
    public function getCountryIdString($msisdnGiven)
    {
        $msisdn = new Msisdn($msisdnGiven);
        return $msisdn->getCountryIdString();
    }
    
    /**
     * @param string $msisdnGiven
     *    
     * @return mobile network operator string or null if not detrmined
     */
    public function getMno($msisdnGiven)
    {
        $msisdn = new Msisdn($msisdnGiven);
        return $msisdn->getMno();
    }

    /**
     * @param string $msisdnGiven
     *    
     * @return mobile network operator string or "Unknown" if not detrmined
     */
    public function getMnoString($msisdnGiven)
    {
        $msisdn = new Msisdn($msisdnGiven);
        return $msisdn->getMnoString();
    }    
 }
 
 $apiMethods = new ApiMethods();
 $server = new \JsonRpc\Server($msisdnJsonRpcApi);
 $server->receive();
