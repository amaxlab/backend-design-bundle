<?php

namespace AmaxLab\Bundle\BackendDesignBundle\Gravatar\Twig;

use AmaxLab\Bundle\BackendDesignBundle\Gravatar\Helper\GravatarHelper;
use AmaxLab\Bundle\BackendDesignBundle\Gravatar\Helper\GravatarHelperInterface;
use Twig_Extension;
use Twig_Function_Method;

/**
 * @author Thibault Duplessis
 * @author Henrik Bjornskov   <hb@peytz.dk>
 */
class GravatarExtension extends Twig_Extension implements GravatarHelperInterface
{
    /**
     * @var GravatarHelper $baseHelper
     */
    protected $baseHelper;

    /**
     * @param GravatarHelperInterface $helper
     */
    public function __construct(GravatarHelperInterface $helper)
    {
        $this->baseHelper = $helper;
    }

    public function getFunctions()
    {
        return array(
            'gravatar'        => new Twig_Function_Method($this, 'getUrl'),
            'gravatar_hash'   => new Twig_Function_Method($this, 'getUrlForHash'),
            'gravatar_exists' => new Twig_Function_Method($this, 'exists'),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getUrl($email, $size = null, $rating = null, $default = null, $secure = null)
    {
        return $this->baseHelper->getUrl($email, $size, $rating, $default, $secure);
    }

    /**
     * {@inheritDoc}
     */
    public function getUrlForHash($hash, $size = null, $rating = null, $default = null, $secure = null)
    {
        return $this->baseHelper->getUrlForHash($hash, $size, $rating, $default, $secure);
    }

    /**
     * {@inheritDoc}
     */
    public function exists($email)
    {
        return $this->baseHelper->exists($email);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ornicar_gravatar';
    }
}
