<?php

namespace AmaxLab\Bundle\BackendDesignBundle\Gravatar\Helper;

use Symfony\Component\HttpFoundation\RequestStack;
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
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * Constructor
     *
     * @param Api $api
     * @param RequestStack $requestStack
     * @internal param ContainerInterface $container
     */
    public function __construct(Api $api, RequestStack $requestStack)
    {
        $this->api          = $api;
        $this->requestStack = $requestStack;
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

        return $this->requestStack->getMasterRequest()->isSecure();
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
