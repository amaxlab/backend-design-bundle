<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 21.01.15
 * Time: 16:35
 */

namespace AmaxLab\Bundle\BackendDesignBundle\Event;

use Knp\Menu\MenuItem;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class CreateMenuEvent
 *
 * @package AmaxLab\Bundle\BackendDesignBundle\Event
 */
class CreateMenuEvent extends Event
{
    /**
     * @var MenuItem
     */
    private $menu;

    /**
     * @param $menu
     */
    public function __construct($menu)
    {
        $this->menu = $menu;
    }

    /**
     * @return MenuItem
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param MenuItem $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }
}