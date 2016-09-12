
# CloudFlare for Laravel

This [Laravel](https://laravel.com/) package helps to determine 
the IP address and current country of the client 
when using [CloudFlare](https://cloudflare.com).

## Installation

From the command line, run:

```
composer require sumanion/laravel-cloudflare
```

## Available Methods

- [`SumanIon\CloudFlare::isTrustedRequest():bool`]() - 
  Returns `true` when current request is comming from *CloudFlare*, 
  otherwise returns `false`.

- [`SumanIon\CloudFlare::onTrustedRequest(Closure):mixed`]() - 
  Executes the `Callback` and returns it's return value 
  when current request is comming from *CloudFlare*, otherwise returns `null`.

- [`SumanIon\CloudFlare::ip():string`]() - 
  Returns current IP address of the client.

> **Note:** When a website is using *CloudFlare* nameservers 
> the `$_SERVER['REMOTE_ADDR']` points to *CloudFlare*, and we have
> to do extra validation to get "the real" IP address of the client.

- [`SumanIon\CloudFlare::country():string`]() - 
  Returns current country of the client.

> **Note:** *CloudFlare* usually sends a `CF_IPCOUNTRY` HTTP header
> with current country of the client.