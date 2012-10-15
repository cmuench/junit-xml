<?php

namespace N98\JUnitXml;

class Document extends \DOMDocument
{
    /**
     * Testsuites element
     *
     * @var \DOMElement
     */
    protected $rootElement;

    public function __construct()
    {
        parent::__construct('1.0', 'UTF-8');
        $this->rootElement = $this->createElement('testsuites');
        $this->appendChild($this->rootElement);
    }

    /**
     * @return TestSuiteElement
     */
    public function addTestSuite()
    {
        $testSuiteElement = new TestSuiteElement();
        $this->rootElement->appendChild($testSuiteElement);
        $testSuiteElement->setAttribute('errors', '0');
        $testSuiteElement->setAttribute('failures', '0');

        return $testSuiteElement;
    }


}