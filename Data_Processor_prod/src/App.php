<?php

namespace Processor;

use Processor\Service\CategoryService;
use Processor\Service\DataProcessorService;

class App
{
    public function execute(): void
    {
        $dataProcessor = new DataProcessorService(CategoryService::getCategoriesData());
        $dataProcessor->process('xml', 'file');
    }
}