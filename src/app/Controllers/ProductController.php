<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Product;
use Exception;

class ProductController
{
    public function index()
    {
        try {
            $products = (new Product())->findAll(20);

            // 3 - Affichage de la liste des produits
            include 'app/views/layout/header.view.php';
            include 'app/views/index.view.php';
            include 'app/views/layout/footer.view.php';
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
            include 'app/views/layout/header.view.php';
            include 'app/views/product.view.php';
            include 'app/views/layout/footer.view.php';

        } catch (Exception $e) {
            (new PageController())->page_500($e->getMessage());
        }
    }
}