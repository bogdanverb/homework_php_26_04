<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette\Application\UI\Presenter;

class EditPagePresenter extends Presenter
{
    protected function startup(): void
    {
        parent::startup();

        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
    }

    public function renderDefault(): void
    {
        // Ваш код для відображення сторінки about
    }
}