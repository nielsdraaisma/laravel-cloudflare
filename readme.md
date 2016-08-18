
# CloudFlare

This [Laravel](https://laravel.com/) package helps to determine real client IP address and
current client country when using [CloudFlare](https://cloudflare.com).

## Installation

From the command line, run:

```
composer require sumanion/laravel-cloudflare
```

## Usage

- `SumanIon\CloudFlare\CloudFlare::ip():string` - Determine current client IP address.
  It also has a helper function `ip()`.

> Used because when using *CloudFlare* nameservers the default IP address
  is the address from *CloudFlare* servers, not the client's IP address.

- `SumanIon\CloudFlare\CloudFlare::country():string` - Determine current country of the client.
  It also has a helper function `country()`.

> When using *CloudFlare*, it sends current client country in the request headers.