<?php
/*
 * Copyright 2016 Bastian Schwarz <schwarz@infomax-it.de>.
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
namespace de\imxnet\imxplatformphp\varnish;

/**
 * Interface that is used to modify a PSR-7 response by adding various headers that will be used by varnish cache
 *
 * Note that since the PSR-7 response is immutable, all methods return a new instance of the response
 *
 * @author Bastian Schwarz <schwarz@infomax-it.de>
 */
interface iResponseModifier {

  /**
   * Shorthand method for making the response cachable.
   *
   * Cachable responses are usually defined by having Cache-Control set to "public" and (s-)max-age > 0
   *
   * Note that since the PSR-7 response is immutable, this method does return a new instance of the response
   *
   * @param \Psr\Http\Message\ResponseInterface $response The original response
   * @param int $sharedMaxAge The value for the s-maxage header in seconds
   * @param array $tags The tags to add to the reponse for mass invalidation
   * @param string $eTag The value for the eTag header
   * @return \Psr\Http\Message\ResponseInterface The new response that is now private
   */
  public function makeCachable(\Psr\Http\Message\ResponseInterface $response, $sharedMaxAge, array $tags = [], $eTag = '');

  /**
   * Sets the max-age header to the reponse
   *
   * Note that since the PSR-7 response is immutable, this method does return a new instance of the response
   *
   * @param \Psr\Http\Message\ResponseInterface $response The original response
   * @param int $maxAge The value for the max-age header in seconds
   * @return \Psr\Http\Message\ResponseInterface The new response that is now private
   */
  public function setMaxAge(\Psr\Http\Message\ResponseInterface $response, $maxAge);

  /**
   * Sets the s-maxage header to the reponse
   *
   * Note that since the PSR-7 response is immutable, this method does return a new instance of the response
   *
   * @param \Psr\Http\Message\ResponseInterface $response The original response
   * @param int $sharedMaxAge The value for the s-maxage header in seconds
   * @return \Psr\Http\Message\ResponseInterface The new response that is now private
   */
  public function setSharedMaxAge(\Psr\Http\Message\ResponseInterface $response, $sharedMaxAge);

  /**
   * Sets the ETag header to the reponse
   *
   * Note that since the PSR-7 response is immutable, this method does return a new instance of the response
   *
   * @param \Psr\Http\Message\ResponseInterface $response The original response
   * @param string $eTag The value for the ETag header
   * @return \Psr\Http\Message\ResponseInterface The new response that is now private
   */
  public function setETag(\Psr\Http\Message\ResponseInterface $response, $eTag);

  /**
   * Sets the response as public, which is required for it to be cachable. This is done by setting the 'Cache-Control' header to 'private'
   *
   * Note that since the PSR-7 response is immutable, this method does return a new instance of the response
   *
   * @param \Psr\Http\Message\ResponseInterface $response The original response
   * @return \Psr\Http\Message\ResponseInterface The new response that is now private
   */
  public function setPublic(\Psr\Http\Message\ResponseInterface $response);

  /**
   * Sets the response as public, which is required for it to be cachable. This is done by setting the 'Cache-Control' header to 'public'
   *
   * Note that since the PSR-7 response is immutable, this method does return a new instance of the response
   *
   * @param \Psr\Http\Message\ResponseInterface $response The original response
   * @return \Psr\Http\Message\ResponseInterface The new response that is now public
   */
  public function setPrivate(\Psr\Http\Message\ResponseInterface $response);

  /**
   * Adds a tag to the response in a http header. This method should ensure that the tags are valid and not added multiple times
   *
   * Note that since the PSR-7 response is immutable, this method does return a new instance of the response
   *
   * @param \Psr\Http\Message\ResponseInterface $response The original response
   * @param string $tag The tag to be added
   * @return \Psr\Http\Message\ResponseInterface The new response that is now private
   */
  public function addTag(\Psr\Http\Message\ResponseInterface $response, $tag);

  /**
   * Adds a collection of tags to the response in a http header. This method should ensure that the tags are valid and not added multiple times
   *
   * Note that since the PSR-7 response is immutable, this method does return a new instance of the response
   *
   * @param \Psr\Http\Message\ResponseInterface $response The original response
   * @param string[] $tags The tag to be added
   * @return \Psr\Http\Message\ResponseInterface The new response that is now private
   */
  public function addTags(\Psr\Http\Message\ResponseInterface $response, array $tags);
}
