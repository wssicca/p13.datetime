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
 * Extensão da classe DateTime com funções 
 * relacionadas somente ao tempo, ignorando a data
 *
 * @author Wagner Sicca <wssicca@gmail.com>
 * @namespace p13\datetime
 * @package p13\datetime
 */
class Time extends DateTime implements ExtensionInterface
{

    /**
     * Retorna a data no formato d/m/Y
     * @return string
     */
    public function __toString()
    {
        return $this->format('H:i');
    }

    /**
     * Faz o "cast" de \DateTime para p13\datetime\Time
     * @param \DateTime $time
     * @return Time
     */
    public static function cast($time)
    {
        return $time instanceof self ?
                $time :
                new self($time->format(self::ISO8601), $time->getTimezone());
    }

}
