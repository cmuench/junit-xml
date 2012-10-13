<?php

require_once __DIR__ . '/../vendor/autoload.php';

use \N98\JUnitXml\Document;

class TestUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Document
     */
    protected $document;

    public function setUp()
    {
        $this->document = new Document();
    }

    public function tearDown()
    {
        unset($this->document);
    }

    /**
     * @test
     */
    public function addTestSuite()
    {
        $suite = $this->document->addTestSuite();
        $timeStamp = new \DateTime();
        $suite->setName('My Test Suite');
        $suite->setTimestamp($timeStamp);
        $suite->setTime(0.344244);

        $testCase = $suite->addTestCase();
        $testCase ->addError('My error 1', 'Exception');
        $testCase ->addError('My error 2', 'Exception');
        $testCase ->addError('My error 3', 'Exception');
        $testCase ->addError('My error 4', 'Exception');
        $testCase ->addFailure('My failure 1', 'Exception');
        $testCase ->addFailure('My failure 2', 'Exception');

        $xmlString = $this->document->saveXML();
        $xml = simplexml_load_string($xmlString);

        $this->assertEquals($timeStamp->format(\DateTime::ISO8601), $xml->testsuite[0]['timestamp']);
        $this->assertEquals('0.344244', $xml->testsuite[0]['time']);
        $this->assertEquals('4', $xml->testsuite[0]['errors']);
        $this->assertEquals('2', $xml->testsuite[0]['failures']);

        // Validate schema
        //$dom = new DOMDocument();
        //$dom->loadXML($xmlString);
        //$this->assertTrue('Schema validation failed', $dom->schemaValidate(__DIR__ . '/specs/junit.xsd'));
    }
}