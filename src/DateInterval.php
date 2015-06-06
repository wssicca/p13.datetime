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

use \DateInterval as OriginalDateInterval;

/**
 * Extensão da classe nativa \DateInterval
 *
 * @author Wagner Sicca <wssicca@gmail.com>
 * @namespace p13\datetime
 * @package p13\datetime
 */
class DateInterval extends OriginalDateInterval implements ExtensionInterface
{

    /**
     * Retorna o número de segundos do intervalo
     * @return int
     */
    public function getSeconds()
    {
        $sec = $this->s;
        $sec += ($this->i * 60);
        $sec += ($this->h * 3600);
        $sec += empty($this->days) ? ($this->d * 86400) : ($this->days * 86400);
        return $sec;
    }

    /**
     * Faz o "cast" de \DateTime para p13\util\datetime\DateTime
     * @param \DateInterval $interval
     * @return DateInterval
     */
    public static function cast($interval)
    {
        if ($interval instanceof self) {
            return $interval;
        } else {
            $myDateInterval = new DateInterval(
                    $interval->format('P%yY%mM%dDT%hH%iM%sS')
            );
            $myDateInterval->invert = $interval->invert;
            return $myDateInterval;
        }
    }

}
