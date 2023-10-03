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

    public function extractEmail(Array &$emails): void
    {
        $search = [
            "mailto:", 
            "Email:", 
            'Email', 
            ' ', 
            'mail',
        ];

        // Define XPath expressions to locate email details 
        $emailXPath = [
            '//a[contains(@href, "mailto:")]',
            '//a[contains(text(), "@")]',
            '//p[contains(text(), "@")]',
            '//p[contains(text(), "Mail:")]',
            '//p[contains(text(), "Email")]',
            '//li[contains(text(), "Email:")]'
        ];

        // Extract email addresses
        foreach($emailXPath as $path)
        {
            $emailNodes = $this->xpath->query($path);
            
            foreach ($emailNodes as $node) 
            {
                $email = !empty($node->getAttribute('href')) ? $node->getAttribute('href') : $node->textContent;
                
                $email = str_replace($search, '', $email);

                if((!in_array($email, $emails)) and (!empty($email)))
                {
                    $emails[] = $email;
                }
            }
        }
    }

    public function extractPhone(Array &$phones): void
    {
        $search = [
            "tel:", 
            "Telefon", 
            'Phone', 
            ' ', 
            "Telephone", 
            ':', 
            "Tel",
        ];

        $phoneXPath = [
            '//a[contains(@href, "tel:")]',
            '//a[contains(@text(), "Tel:")]',
            '//p[contains(text(), "Tel:")]',
            '//p[contains(text(), "+")]',
            '//p[contains(text(), "Phone:")]',
            '//p[contains(text(), "Phone")]',
            '//li[contains(text(), "Telefon")]',
            '//li[contains(text(), "Telephone")]',
            '//p[contains(text(), "Telephone:")]',
            '//p[contains(text(), "Telephone")]',
        ];

        // Extract phone numbers
        foreach($phoneXPath as $path)
        {
            $phoneNodes = $this->xpath->query($path);
            
            foreach ($phoneNodes as $node)
            {
                $phone = !empty($node->getAttribute('href')) ? $node->getAttribute('href') : $node->textContent;
                $phone = str_replace($search, '', $phone);
                $phone = formatPhoneNumber($phone);

                if((!in_array($phone, $phones)) and (!empty($phone)))
                {
                    $phones[] = $phone;
                }
            }
        }
    }
}