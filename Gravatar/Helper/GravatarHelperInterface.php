<?php

namespace AmaxLab\Bundle\BackendDesignBundle\Gravatar\Helper;

/**
 * Interface GravatarHelperInterface.
 */
interface GravatarHelperInterface
{
    /**
     * Returns a url for a gravatar.
     *
     * @param string      $email
     * @param null|int    $size
     * @param null|string $rating
     * @param null|string $default
     * @param null|bool   $secure
     *
     * @return string
     */
    public function getUrl($email, $size = null, $rating = null, $default = null, $secure = null);

    /**
     * Returns a url for a gravatar for a given hash.
     *
     * @param string      $hash
     * @param null|int    $size
     * @param null|string $rating
     * @param null|string $default
     * @param null|bool   $secure
     *
     * @return string
     */
    public function getUrlForHash($hash, $size = null, $rating = null, $default = null, $secure = null);

    /**
     * Returns true if a avatar could be found for the email.
     *
     * @param string    $email
     * @param null|bool $secure
     *
     * @return bool
     */
    public function exists($email, $secure = null);
}
