<?php

if (!function_exists('ip')) {

    /**
     * Determine current client IP address
     *
     * @return string
     */
    function ip()
    {
        return SumanIon\CloudFlare\CloudFlare::ip();
    }
}

if (!function_exists('country')) {

    /**
     * Determine current country of the client
     *
     * @return string
     */
    function country()
    {
        return SumanIon\CloudFlare\CloudFlare::country();
    }
}