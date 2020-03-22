<?php

namespace App\Model;

use Nette;

class UrlManager
{
	use Nette\SmartObject;

    public function string_between_two_string($str, $starting_word, $ending_word) 
    { 
      $subtring_start = strpos($str, $starting_word); 
      //Adding the strating index of the strating word to  
      //its length would give its ending index 
      $subtring_start += strlen($starting_word);   
      //Length of our required sub string 
      $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;   
      // Return the substring from the index substring_start of length size  
      return substr($str, $subtring_start, $size);  
    }     

    public function urlExplode($url)
    {
        return (explode("/",$url));
    } 
    
    public function urlCode($url, $position = 4)
    {
        $code = $this->urlExplode($url);
        return $code[$position];
    }

    public function urlCorrect($url)
    {
        $code = $this->urlExplode($url, 2);
        return $code == "online.sktorrent.eu";
    }    

    public function videoInfo($url)
    {
        $str = file_get_contents($url);  
        $code = $this->string_between_two_string($str, 'source src="http://online', '.sktorrent.eu'); 
        $title = $this->string_between_two_string($str, '<title>', ' - SkTonline</title>'); 
        return [
            'code' => $code,
            'title' => $title,
        ];
    }    


    

}
