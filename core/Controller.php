<?php
namespace Core;
use \R;
use League\Plates\Engine;
use \League\Plates\Extension\Asset;

abstract class Controller
{
    /**
     * @var \League\Plates\Engine
     */
    protected $templates;

    /**
     * Controller constructor.
     * @param string|null $path
     */
    public function __construct(string $path = null)
    {
        R::setup( 'mysql:host=localhost;dbname=shop', 'root', 'Ghjuth99' );
        R::exec('SET NAMES utf8');
        $this->templates = Engine::create($path);
        $this->templates->addData([
            'menu' => $this->menu(),
            'logo'=>$this->logo('Шико')
        ]);
    }

    /**
     * @return array
     */
    public function menu():array
    {
        return [
            ['name' => 'Каталог',   'slug' => '/catalog/list'],
            ['name' => 'Про нас',   'slug' => '/about'],
            ['name' => 'Доставка',  'slug' => '/delivery'],
            ['name' => 'Знижки',    'slug' => '/discounts'],
            ['name' => 'Контакти',  'slug' => '/contacts'],
        ];
    }

    /**
     * @param string $logo
     * @return string
     */
    public function logo(string $logo):string
    {
        if($_SERVER['REQUEST_URI'] === '/'){
            return "<span>{$logo}</span>";
        }
        return "<a href='/'>{$logo}</a>";
    }
    /**
     * @param string $viewname
     * @param array $variables
     * @return string
     */
    protected function render(string $viewname, array $variables=[])
    {
        return $this->templates->render($viewname, $variables);
    }
}