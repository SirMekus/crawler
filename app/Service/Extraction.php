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
        $emailXPath = getXpath();

        // Extract email addresses
        foreach($emailXPath['email'] as $path)
        {
            $emailNodes = $this->xpath->query($path);
            
            foreach ($emailNodes as $node) 
            {
                $email = !empty($node->getAttribute('href')) ? $node->getAttribute('href') : $node->textContent;
                
                $email = extractEmail($email);
                
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
            'Phones', 
            "Telephone", 
            ':', 
            "Tel",
        ];

        $phoneXPath = getXpath();

        // Extract phone numbers
        foreach($phoneXPath['phone'] as $path)
        {
            $phoneNodes = $this->xpath->query($path);
            
            foreach ($phoneNodes as $node)
            {
                $phone = !empty($node->getAttribute('href')) ? $node->getAttribute('href') : $node->textContent;
                
                $phone = str_replace($search, '', $phone);

                //In case it is a string where multiple numbers are joined together. E,g, 090*** and 080***, 0803***. It splits them and removes the non-digits. 
                $phoneNumbers = extractPhoneNumber($phone);

                foreach ($phoneNumbers as $number)
                {
                    $phone = formatPhoneNumber($number);

                    if((!in_array($phone, $phones)) and (!empty($phone)))
                    {
                        $phones[] = $phone;
                    }
                }
            }
        }
    }
}