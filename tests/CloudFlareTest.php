<?php

use SumanIon\CloudFlare;
use Illuminate\Support\Facades\Request;

class CloudFlareTest extends TestCase
{
    /** @var string A regular IP address */
    protected $ip   = '127.0.0.1';

    /** @var string A valid CloudFlare IP address. */
    protected $cfIp = '131.0.72.1';

    public function test_it_can_determine_trusted_requests()
    {
        Request::shouldReceive('ip')->once()->andReturn($this->ip);
        $this->assertFalse(CloudFlare::isTrustedRequest());

        Request::shouldReceive('ip')->once()->andReturn($this->cfIp);
        $this->assertTrue(CloudFlare::isTrustedRequest());
    }

    public function test_it_can_execute_callbacks_on_trusted_requests()
    {
        Request::shouldReceive('ip')->once()->andReturn($this->ip);
        $this->assertNull(CloudFlare::onTrustedRequest(function () { return true; }));

        Request::shouldReceive('ip')->once()->andReturn($this->cfIp);
        $this->assertTrue(CloudFlare::onTrustedRequest(function () { return true; }));
    }

    public function test_it_can_determine_the_real_ip_address()
    {
        Request::shouldReceive('ip')->once()->andReturn($this->ip);
        $this->assertSame($this->ip, CloudFlare::ip());

        Request::shouldReceive('ip')->once()->andReturn($this->cfIp);
        Request::shouldReceive('header')->once()->with('CF_CONNECTING_IP')->andReturn('10.10.10.10');
        $this->assertSame('10.10.10.10', CloudFlare::ip());
    }

    public function test_it_can_determine_current_country()
    {
        Request::shouldReceive('ip')->once()->andReturn($this->ip);
        $this->assertEmpty(CloudFlare::country());

        Request::shouldReceive('ip')->once()->andReturn($this->cfIp);
        Request::shouldReceive('header')->once()->with('CF_IPCOUNTRY')->andReturn('MD');
        $this->assertSame('MD', CloudFlare::country());
    }
}
