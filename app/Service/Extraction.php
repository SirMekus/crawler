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
        //$emails = [];

        $search = ["mailto:", "Email:", ' '];

        // Define XPath expressions to locate contact details (modify these according to your webpage structure)
        //$emailXPath = '//a[contains(@href, "mailto:")]';

        $emailXPath = [
            '//a[contains(@href, "mailto:")]',
        ];

        // Extract email addresses
        foreach($emailXPath as $path)
        {
            $emailNodes = $this->xpath->query($path);
            
            foreach ($emailNodes as $node) 
            {
                $email = !empty($node->getAttribute('href')) ? $node->getAttribute('href') : $node->textContent;
                
                $email = str_replace($search, '', $email);

                //echo "Email: ".$email.PHP_EOL;

                if((!in_array($email, $emails)) and (!empty($email)))
                {
                    $emails[] = $email;
                }
            }
        }
    }

    public function extractPhone(Array &$phones): void
    {
        $search = ["tel:", "Telefon", "Phone:", ' '];

        $phoneXPath = [
            '//a[contains(@href, "tel:")]',
            '//p[contains(text(), "Phone:")]',
            '//p[contains(text(), "Phone")]',
            '//li[contains(text(), "Telefon")]'
        ];

        // Extract phone numbers
        foreach($phoneXPath as $path)
        {
            $phoneNodes = $this->xpath->query($path);
            
            foreach ($phoneNodes as $node) 
            {
                $phone = !empty($node->getAttribute('href')) ? $node->getAttribute('href') : $node->textContent;
                $phone = str_replace($search, '', $phone);//formatPhoneNumber
                $phone = formatPhoneNumber($phone);
                //echo "phone: ".$phone.PHP_EOL;

                if((!in_array($phone, $phones)) and (!empty($phone)))
                {
                    $phones[] = $phone;
                }
            }
        }
    }
}