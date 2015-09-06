<?php

/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 21.01.15
 * Time: 16:35.
 */
namespace AmaxLab\Bundle\BackendDesignBundle\Event;

use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class CreateMenuEvent.
 */
class CreateMenuEvent extends Event
{
    /**
     * @var ItemInterface
     */
    private $menu;

    /**
     * @param ItemInterface $menu
     */
    public function __construct($menu)
    {
        $this->menu = $menu;
    }

    /**
     * @return ItemInterface
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param ItemInterface $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }
}
