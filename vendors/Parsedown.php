<?php
// Parsedown
// http://parsedown.org
// (c) Emanuil Rusev
// http://erusev.com
//
// This is a simplified placeholder for the Parsedown library.
// Please download the full library from https://github.com/erusev/parsedown

class Parsedown
{
    protected $safeMode = false;

    function text($text)
    {
        // If using this code in production, please download the full Parsedown library
        // This is just a basic implementation for demonstration
        
        if ($this->safeMode)
        {
            $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        }
        
        // Basic Markdown parsing
        // Headers
        $text = preg_replace('/^# (.*?)$/m', '<h1>$1</h1>', $text);
        $text = preg_replace('/^## (.*?)$/m', '<h2>$1</h2>', $text);
        $text = preg_replace('/^### (.*?)$/m', '<h3>$1</h3>', $text);
        
        // Bold and Italic
        $text = preg_replace('/\*\*(.*?)\*\*/s', '<strong>$1</strong>', $text);
        $text = preg_replace('/\*(.*?)\*/s', '<em>$1</em>', $text);
        
        // Links
        $text = preg_replace('/\[(.*?)\]\((.*?)\)/s', '<a href="$2">$1</a>', $text);
        
        // Lists
        $text = preg_replace('/^\* (.*?)$/m', '<li>$1</li>', $text);
        $text = preg_replace('/(<li>.*?<\/li>(\n|$))+/s', '<ul>$0</ul>', $text);
        
        // Paragraphs
        $text = '<p>' . preg_replace('/\n\n/', '</p><p>', $text) . '</p>';
        $text = str_replace('<p><h', '<h', $text);
        $text = str_replace('</h1></p>', '</h1>', $text);
        $text = str_replace('</h2></p>', '</h2>', $text);
        $text = str_replace('</h3></p>', '</h3>', $text);
        $text = str_replace('<p><ul>', '<ul>', $text);
        $text = str_replace('</ul></p>', '</ul>', $text);
        
        return $text;
    }
    
    function setSafeMode($value)
    {
        $this->safeMode = (bool) $value;
        return $this;
    }
}
