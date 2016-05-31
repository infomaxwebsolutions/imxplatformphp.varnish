imxplatformphp.varnish
==========================
This module helps at controlling <a href="https://varnish-cache.org/" target="_blank">Varnish Cache</a> via cache headers.

#Installation
Easiest way is via composer:
```json
"require": {
  "infomax/imxplatformphp.varnish": "*"
}
```

#Features
-Defining reasonable defaults for Cache-Control and TTL
-Providing an explicit API to influence caching
-Collecting tags to purge/ban multiple cache entries
