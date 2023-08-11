<?php

namespace App\Controllers;

class PageController
{
    public function page_404(): void
    {
        include 'app/views/layout/header.view.php';
        include 'app/views/404.view.php';
        include 'app/views/layout/footer.view.php';
    }

    public function page_500(string $errorMessage = ""): void
    {
        $error = $errorMessage;
        include 'app/views/layout/header.view.php';
        include 'app/views/500.view.php';
        include 'app/views/layout/footer.view.php';
    }
}