<?php

/*
 * This file is part of the P13/DateTime package.
 * 
 * (c) Wagner Sicca <wssicca@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace p13\datetime;

/**
 * Interface que assina método de cast para classes que herdam classes built-in
 * de datas do PHP.
 * @author Wagner Sicca <wssicca@gmail.com>
 * @namespace p13\datetime
 * @package p13\datetime
 */
interface ExtensionInterface
{

    static function cast($object);
}
