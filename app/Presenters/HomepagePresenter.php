<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Http\Url;


class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private $database;

	// pro práci s vrstvou Database Explorer si předáme Nette\Database\Context
	public function __construct(Nette\Database\Connection $database)
	{
		$this->database = $database;
	}    
    
    
    public function createComponentSearchForm(): Form
    {        
        $httpRequest = $this->getHttpRequest();

        $name = $this->database->fetchField('SELECT count FROM loging ORDER BY id DESC LIMIT 1');
       
        $this->database->query('INSERT INTO loging ?',[
            'ip' => $httpRequest->getRemoteAddress(),
            'from' => $httpRequest->getReferer() ? $httpRequest->getReferer() : "noUrl",
            'count' => ++$name,
        ]);        
        
        $form = new Form; // means Nette\Application\UI\Form
    
        $form->addText('url', 'URL:') 
            ->setRequired();
    
        $form->addSubmit('send', 'Find');

        $form->onSuccess[] = [$this, 'searchFormSucceeded'];
    
        return $form;
    }

    public function searchFormSucceeded(Form $form, \stdClass $values): void
    {
        //$this->flashMessage($values->url, 'success');
        $this->redirect('Video:show',$values->url);


    }    
    
}
