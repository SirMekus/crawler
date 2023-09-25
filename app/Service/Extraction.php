<?php
namespace App\Service;

class Extraction
{
    private $xpath;

    public function __construct($doc)
    {
        // Create a DOMXPath instance to query the DOM
        $this->xpath = new \DOMXPath($doc);   
    }

    public function extractEmail(&$emails): Array
    {
        //$emails = [];

        // Define XPath expressions to locate contact details (modify these according to your webpage structure)
        $emailXPath = '//a[contains(@href, "mailto:")]';

        // Extract email addresses
        $emailNodes = $this->xpath->query($emailXPath);

        foreach ($emailNodes as $node) 
        {
            if((!in_array($node->getAttribute('href'), $emails)) and (!empty($node->getAttribute('href'))))
            {
                $emails[] = explode("mailto:",$node->getAttribute('href'))[1];
            }
        }

        return $emails;
    }

    public function extractPhone(&$phones): Array
    {
        // $phoneXPath = '//p[contains(text(), "Phone:")]';
        $phoneXPath = '//a[contains(@href, "tel:")]';

        // Extract phone numbers
        $phoneNodes = $this->xpath->query($phoneXPath);
            
        foreach ($phoneNodes as $node) 
        {
            // $phones[] = explode("tel:",$node->getAttribute('href'))[1];

            if((!in_array($node->getAttribute('href'), $phones)) and (!empty($node->getAttribute('href'))))
            {
                // $phones[] = trim(str_replace('Phone:', '', $node->textContent));
                $phones[] = explode("tel:",$node->getAttribute('href'))[1];
            }
        }

        return $phones;
    }
}