<?php

namespace AmaxLab\Bundle\BackendDesignBundle\Gravatar\Helper;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Templating\Helper\Helper;
use Amaxlab\Bundle\BackendDesignBundle\Gravatar\Api;

/**
 * Symfony 2 Helper for Gravatar. Uses AmaxLab\Bundle\BackendDesignBundle\Gravatar\Api
 *
 * @author Thibault Duplessis
 * @author Henrik Bjornskov <henrik@bearwoods.dk>
 */
class GravatarHelper extends Helper implements GravatarHelperInterface
{
    /**
     * @var Api $api
     */
    protected $api;

    /**
     * @var ContainerInterface $container
     */
    protected $container;

    /**
     * Constructor
     *
     * @param Api        $api
     * @param ContainerInterface $container
     */
    public function __construct(Api $api, ContainerInterface $container = null)
    {
        $this->api = $api;
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function getUrl($email, $size = null, $rating = null, $default = null, $secure = null)
    {
        return $this->api->getUrl($email, $size, $rating, $default, $this->isSecure($secure));
    }

    /**
     * {@inheritDoc}
     */
    public function getUrlForHash($hash, $size = null, $rating = null, $default = null, $secure = null)
    {
        return $this->api->getUrlForHash($hash, $size, $rating, $default, $this->isSecure($secure));
    }

    public function render($email, array $options = array())
    {
        $size = isset($options['size'])?$options['size']:null;
        $rating = isset($options['rating'])?$options['rating']:null;
        $default = isset($options['default'])?$options['default']:null;
        $secure = $this->isSecure();

        return $this->api->getUrl($email, $size, $rating, $default, $secure);
    }

    /**
     * {@inheritDoc}
     */
    public function exists($email)
    {
        return $this->api->exists($email);
    }

    /**
     * Returns true if avatar should be fetched over secure connection
     *
     * @param mixed $preset
     * @return Boolean
     */
    protected function isSecure($preset = null)
    {
        if (null !== $preset) {
            return !!$preset;
        }

        if (!$this->container || !$this->container->has('router')) {
            return false;
        }

        return 'https' == strtolower($this->container->get('router')->getContext()->getScheme());
    }

    /**
     * Name of this Helper
     *
     * @return string
     */
    public function getName()
    {
        return 'gravatar';
    }
}
