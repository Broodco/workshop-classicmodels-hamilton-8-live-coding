<?php
declare(strict_types=1);

namespace Controllers;

use Exception;
use Models\Product;

class ProductController
{
    public function index()
    {
        try {
            $products = (new Product())->findAll(20);

            // 3 - Affichage de la liste des produits
            include 'views/layout/header.view.php';
            include 'views/index.view.php';
            include 'views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function show(string $productCode)
    {
        try {
            $product = (new Product())->find($productCode);

            if (empty($product)) {
                (new PageController())->page_404();
                die;
            }

            // 3 - Afficher la page
            include 'views/layout/header.view.php';
            include 'views/product.view.php';
            include 'views/layout/footer.view.php';

        } catch (Exception $e) {
            (new PageController())->page_500($e->getMessage());
        }
    }
}