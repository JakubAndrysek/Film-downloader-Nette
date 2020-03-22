<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;


class HomepagePresenter extends Nette\Application\UI\Presenter
{

    protected function createComponentSearchForm(): Form
    {
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
