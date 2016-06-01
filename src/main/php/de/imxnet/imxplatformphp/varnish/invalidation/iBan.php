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
 * Interface for banning entries from varnish. This interface mainly exist so we are not directly bound to the 3rd party interface.
 * 
 * @author Bastian Schwarz <bastian@codename-php.de>
 */
interface iBan extends \FOS\HttpCache\ProxyClient\Invalidation\BanInterface {
//put your code here
}
