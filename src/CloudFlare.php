<?php

namespace SumanIon\CloudFlare;

use Request;
use Symfony\Component\HttpFoundation\IpUtils;

class CloudFlare
{
    /**
     * List of IP's used by CloudFlare
     * @var array
     */
    protected static $ips = [
        '103.21.244.0/22',
        '103.22.200.0/22',
        '103.31.4.0/22',
        '104.16.0.0/12',
        '108.162.192.0/18',
        '131.0.72.0/22',
        '141.101.64.0/18',
        '162.158.0.0/15',
        '172.64.0.0/13',
        '173.245.48.0/20',
        '188.114.96.0/20',
        '190.93.240.0/20',
        '197.234.240.0/22',
        '198.41.128.0/17',
        '199.27.128.0/21',
        '2400:cb00::/32',
        '2405:8100::/32',
        '2405:b500::/32',
        '2606:4700::/32',
        '2803:f800::/32',
    ];

    /**
     * Check if request is coming from CloudFlare servers
     *
     * @return bool
     */
    public static function isTrustedRequest():bool
    {
        return IpUtils::checkIp(Request::ip(), static::$ips);
    }

    /**
     * Determine the real IP of the client
     *
     * @return string
     */
    public static function ip():string
    {
        if (static::isTrustedRequest()) {

            $cf_ip = Request::header('CF_CONNECTING_IP');

            if (false !== filter_var($cf_ip, FILTER_VALIDATE_IP)) {

                return $cf_ip;
            }
        }

        return Request::ip();
    }

    /**
     * Determine current country of the client
     *
     * @return string
     */
    public static function country():string
    {
        if (static::isTrustedRequest()) {
            return Request::header('CF_IPCOUNTRY') ?? '';
        }

        return '';
    }
}