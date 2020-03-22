<?php


namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

use App\Model\UrlManager;


class VideoPresenter extends Nette\Application\UI\Presenter
{

	private $urlManager;

	public function __construct(UrlManager $urlManager)
	{
		$this->urlManager = $urlManager;
    }
    
    
    public function renderShow($url): void
    {       

        if ($this->urlManager->urlCorrect($url)) {
            $this->error('Nespravna adresa URL');
        }

        $urlCode = $this->urlManager->urlCode($url);

        $videoCode = $this->urlManager->videoInfo($url)['code'];

        $videoTitle = $this->urlManager->videoInfo($url)['title'];

        $this->template->urlcode = [
            'url' => $url,
            'urlCode' => $urlCode,
            'videoCode' => $videoCode, 
            'title'=>$videoTitle
        ];     
    }    


}