<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette\Application\UI\Presenter;

class AboutPresenter extends Presenter
{
    public function renderDefault(): void
    {
        $this->template->pageTitle = 'About';
        // Інші змінні, які ви хочете передати до шаблону

        // Відображення шаблону
        $this->template->render(__DIR__ . '/templates/about.latte');
    }
}