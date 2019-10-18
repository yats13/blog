<?php

namespace Frontend\Controllers;
use R;
use Core\Controller;

final class CatalogController extends Controller
{
    public function __construct()
    {
        $path = dirname(__DIR__,1).'/views';
        parent::__construct($path);
    }

    public function getList()
    {
        $data ['categories'] = R::getAll('SELECT c.name, c.slug, cp.category_id FROM category_parent cp LEFT JOIN category c ON c.id = cp.category_id WHERE cp.category_parent IS NULL');
        return $this->render('catalog/list.phtml', $data);
    }

    public function getIndex($slug)
    {
        $data['name'] ="One";
        $category = R::getRow('SELECT * FROM category WHERE slug = :slug', [':slug' => $slug]);
        $data ['category'] = $category;
        $categories = R::getAll('SELECT c.name, c.slug, cp.category_id FROM category_parent cp LEFT JOIN category c ON c.id = cp.category_id WHERE cp.category_parent = :id', ['id' => $category['id']]);
        $data ['categories'] = $categories;
        $data ['products'] = R::getAll('SELECT p.name, p.slug, p.price, p.brand_id, p.stock_id FROM category_product cp LEFT JOIN product p ON p.id = cp.product_id WHERE cp.category_id IN(:categories)', ['categories' => $category['id']]);
        return $this->render('catalog/list.phtml', $data);
    }
}