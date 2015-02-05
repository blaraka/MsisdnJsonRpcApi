<?php

namespace MateuszKrasucki\MsisdnJsonRpcApi;

use MateuszKrasucki\MsisdnJsonRpcApi\ApiMethods;

class MsisdnTest extends \PHPUnit_Framework_TestCase
{

    public function testWrongString()
    {
        $msisdnApiMethods = new ApiMethods();
        $testStrings = ['numer', '+001230000'];
        foreach ($testStrings as $testString) {
            $this->assertEquals(null, $msisdnApiMethods->getMsisdn($testString));
            $this->assertEquals(null, $msisdnApiMethods->getNationalNumber($testString));
            $this->assertEquals(null, $msisdnApiMethods->getCountryCode($testString));
            $this->assertEquals(null, $msisdnApiMethods->getCountryId($testString));
            $this->assertEquals(null, $msisdnApiMethods->getMno($testString));
        
            $allProperties = array(
                "msisdnGiven"    => $testString,
                "msisdn"  => null,
                "nationalNumber"  => null,
                "countryCode" => null,
                "countryId" => null,
                "mno" => null,
            );
            $this->assertEquals($allProperties, $msisdnApiMethods->getAllProperties($testString));
        
            $this->assertEquals('Unknown', $msisdnApiMethods->getMsisdnString($testString));
            $this->assertEquals('Unknown', $msisdnApiMethods->getNationalNumberString($testString));
            $this->assertEquals('Unknown', $msisdnApiMethods->getCountryCodeString($testString));
            $this->assertEquals('Unknown', $msisdnApiMethods->getCountryIdString($testString));
            $this->assertEquals('Unknown', $msisdnApiMethods->getMnoString($testString));
        
            $this->assertEquals('Unknown, Unknown, Unknown, Unknown', $msisdnApiMethods->getFullString($testString));
        }
    }
    
    public function testNonexistentCountryCode()
    {
        $msisdnApiMethods = new ApiMethods();
        $testString = '+425230000';
        $this->assertEquals('425230000', $msisdnApiMethods->getMsisdn($testString));
        $this->assertEquals(null, $msisdnApiMethods->getNationalNumber($testString));
        $this->assertEquals(null, $msisdnApiMethods->getCountryCode($testString));
        $this->assertEquals(null, $msisdnApiMethods->getCountryId($testString));
        $this->assertEquals(null, $msisdnApiMethods->getMno($testString));
        
        $allProperties = array(
            "msisdnGiven"    => $testString,
            "msisdn"  => '425230000',
            "nationalNumber"  => null,
            "countryCode" => null,
            "countryId" => null,
            "mno" => null,
        );
        $this->assertEquals($allProperties, $msisdnApiMethods->getAllProperties($testString));
        
        $this->assertEquals('425230000', $msisdnApiMethods->getMsisdnString($testString));
        $this->assertEquals('Unknown', $msisdnApiMethods->getNationalNumberString($testString));
        $this->assertEquals('Unknown', $msisdnApiMethods->getCountryCodeString($testString));
        $this->assertEquals('Unknown', $msisdnApiMethods->getCountryIdString($testString));
        $this->assertEquals('Unknown', $msisdnApiMethods->getMnoString($testString));
        
        $this->assertEquals('Unknown, Unknown, Unknown, Unknown', $msisdnApiMethods->getFullString($testString));
    }
    
    
    public function testWithJSONExamples()
    {
        $msisdnApiMethods = new ApiMethods();
        $examplesFilepath = __DIR__
                            . '/resources/test.json';
        $examples = json_decode(file_get_contents($examplesFilepath), true);
        
        foreach ($examples as $example) {
            $this->assertEquals(
                ($example[1] == 'Unknown' ? null : $example[1]),
                $msisdnApiMethods->getMsisdn($example[0])
            );
            $this->assertEquals(
                ($example[2] == 'Unknown' ? null : $example[2]),
                $msisdnApiMethods->getCountryCode($example[0])
            );
            $this->assertEquals(
                ($example[3] == 'Unknown' ? null : $example[3]),
                $msisdnApiMethods->getCountryId($example[0])
            );
            $this->assertEquals(
                ($example[4] == 'Unknown' ? null : $example[4]),
                $msisdnApiMethods->getNationalNumber($example[0])
            );
            $this->assertEquals(
                ($example[5] == 'Unknown' ? null : $example[5]),
                $msisdnApiMethods->getMno($example[0])
            );
        
            $allProperties = array(
                "msisdnGiven"    => $example[0],
                "msisdn"  => ($example[1] == 'Unknown' ? null : $example[1]),
                "nationalNumber"  => ($example[4] == 'Unknown' ? null : $example[4]),
                "countryCode" => ($example[2] == 'Unknown' ? null : $example[2]),
                "countryId" => ($example[3] == 'Unknown' ? null : $example[3]),
                "mno" => ($example[5] == 'Unknown' ? null : $example[5]),
            );
            $this->assertEquals($allProperties, $msisdnApiMethods->getAllProperties($example[0]));
        
            $this->assertEquals($example[1], $msisdnApiMethods->getMsisdnString($example[0]));
            $this->assertEquals($example[2], $msisdnApiMethods->getCountryCodeString($example[0]));
            $this->assertEquals($example[3], $msisdnApiMethods->getCountryIdString($example[0]));
            $this->assertEquals($example[4], $msisdnApiMethods->getNationalNumberString($example[0]));
            $this->assertEquals($example[5], $msisdnApiMethods->getMnoString($example[0]));
        
            $this->assertEquals(
                ($example[5] . ', ' . $example[2]
                . ', ' . $example[4] . ', ' . $example[3]),
                $msisdnApiMethods->getFullString($example[0])
            );
        }
    }
}
