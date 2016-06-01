<?php
/*
 * Copyright 2016 Bastian Schwarz <bastian@codename-php.de>.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * @namespace
 */
namespace de\imxnet\imxplatformphp\varnish\invalidation;

/**
 * This is a proxy for the FOSHttpCache varnish client. Since we are only interested in banning (because we deal with tags, not individual URLs), only out iBan inteface is
 * implemented. All calls are delegated to the FOSHttpCache varnish client and our instance is returned for the fluent interface
 *
 * @author Bastian Schwarz <bastian@codename-php.de>
 */
class FOSHttp implements iBan {

  /**
   * The client that handles the acutal calls to varnish
   *
   * @var \FOS\HttpCache\ProxyClient\Varnish
   */
  private $client = null;

  /**
   * Sets the given client
   *
   * @param \FOS\HttpCache\ProxyClient\Varnish $client The client that handles the actual calls to varnish
   */
  public function __construct(\FOS\HttpCache\ProxyClient\Varnish $client) {
    $this->setClient($client);
  }

  /**
   *
   * @return \FOS\HttpCache\ProxyClient\Varnish
   */
  public function getClient() {
    return $this->client;
  }

  /**
   *
   * @param \FOS\HttpCache\ProxyClient\Varnish $client
   * @return self
   */
  public function setClient(\FOS\HttpCache\ProxyClient\Varnish $client) {
    $this->client = $client;
    return $this;
  }

  /**
   * Ban cached objects matching HTTP headers
   *
   * Each header is either a:
   * - regular string ('X-Host' => 'example.com')
   * - or a POSIX regular expression ('X-Host' => '^(www\.)?(this|that)\.com$').
   *
   * Please make sure to configure your HTTP caching proxy to set the headers
   * supplied here on the cached objects. So if you want to match objects by
   * host name, configure your proxy to copy the host to a custom HTTP header
   * such as X-Host.
   *
   * @param array $headers HTTP headers that path must match to be banned.
   * @return self
   */
  public function ban(array $headers) {
    $this->getClient()->ban($headers);
    return $this;
  }

  /**
   * Ban URLs based on a regular expression for the URI, an optional
   * content type and optional limit to certain hosts.
   *
   * The hosts parameter can either be a regular expression, e.g.
   * '^(www\.)?(this|that)\.com$' or an array of exact host names, e.g.
   * array('example.com', 'other.net'). If the parameter is empty, all hosts
   * are matched.

   * @param string       $path        Regular expression pattern for URI to
   *                                  invalidate.
   * @param string       $contentType Regular expression pattern for the content
   *                                  type to limit banning, for instance 'text'.
   * @param array|string $hosts       Regular expression of a host name or list
   *                                  of exact host names to limit banning.
   * @return self
   */
  public function banPath($path, $contentType = null, $hosts = null) {
    $this->getClient()->banPath($path, $contentType, $hosts);
    return $this;
  }

  /**
   * Send all pending invalidation requests.
   *
   * @return int The number of cache invalidations performed per caching server.
   * @throws \de\imxnet\imxplatformphp\varnish\Exception If any errors occurred during flush.
   */
  public function flush() {
    try {
      $this->getClient()->flush();
      return $this;
    }catch(\FOS\HttpCache\Exception\ExceptionCollection $flushingFailed) {
      throw new \de\imxnet\imxplatformphp\varnish\Exception('The flushing failed!', 0, $flushingFailed);
    }
  }
}
