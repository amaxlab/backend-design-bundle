<?php

namespace AmaxLab\Bundle\BackendDesignBundle\Menu;


use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Knp\Menu\Matcher\MatcherInterface;
use Knp\Menu\MenuItem;
use AmaxLab\Bundle\BackendDesignBundle\Event\CreateMenuEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class Builder
 *
 * @package AmaxLab\Bundle\BackendDesignBundle\Menu
 */
class Builder
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var MatcherInterface
     */
    private $matcher;

    /**
     * @var MenuItem
     */
    private $menu;

    /**
     * @param FactoryInterface         $factory
     * @param EventDispatcherInterface $dispatcher
     * @param MatcherInterface         $matcher
     */
    public function __construct(FactoryInterface $factory, EventDispatcherInterface $dispatcher, MatcherInterface $matcher)
    {
        $this->factory    = $factory;
        $this->dispatcher = $dispatcher;
        $this->matcher    = $matcher;

        $this->menu = $this->factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'nav navbar-nav navbar-right',
            ),
        ));

        $event = new CreateMenuEvent($this->menu);
        $this->dispatcher->dispatch('amaxlab.backend_design.create_menu', $event);
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

    /**
     * @return MenuItem
     */
    public function getAffixMenu()
    {
        $menu = $this->findFirstLevelActive($this->menu);

        if (!$menu) {
            $menu = $this->factory->createItem('root', array(
                'childrenAttributes' => array(
                    'class' => 'nav nav-sidebar',
                ),
            ));
        }

        $menu->setChildrenAttributes(array(
            'class' => 'nav nav-sidebar',
        ));

        return $menu;
    }

    /**
     * @param ItemInterface $rootItem
     *
     * @return ItemInterface|null
     */
    private function findFirstLevelActive(ItemInterface $rootItem)
    {
        foreach ($rootItem as $firstLevelItem) {
            if ($this->matcher->isCurrent($firstLevelItem) || $this->matcher->isAncestor($firstLevelItem)){
                return $firstLevelItem;
            }
        }

        return null;
    }
}
