<?php

namespace AmaxLab\Bundle\BackendDesignBundle\Twig;

use AmaxLab\Bundle\BackendDesignBundle\Gravatar\Helper\GravatarHelperInterface;
use Twig_Extension;

/**
 * @author Thibault Duplessis
 * @author Henrik Bjornskov   <hb@peytz.dk>
 */
class GravatarExtension extends Twig_Extension
{
    /**
     * @var GravatarHelperInterface
     */
    protected $baseHelper;

    /**
     * @param GravatarHelperInterface $helper
     */
    public function __construct(GravatarHelperInterface $helper)
    {
        $this->baseHelper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('gravatar', array($this->baseHelper, 'getUrl')),
            new \Twig_SimpleFunction('gravatar_hash', array($this->baseHelper, 'getUrlForHash')),
            new \Twig_SimpleFunction('gravatar_exists', array($this->baseHelper, 'exists')),
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'amaxlab_gravatar_extension';
    }
}
