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
 * Description of Year
 *
 * @author Wagner Sicca <wssicca@gmail.com>
 * @namespace p13\datetime
 * @package p13\datetime
 */
class Year extends DateRange
{

    /**
     * Indica se é o ano atual
     * @const CURRENT_YEAR
     */
    const CURRENT_YEAR = 0;

    /**
     * Número do ano
     * @var int
     */
    public $year;

    /**
     * 
     * @param integer $year
     */
    public function __construct($year = self::CURRENT_YEAR)
    {
        $this->year = $year;
        $startDate = new Date("$year-01-01");
        $endDate = new Date("$year-12-31");
        parent::__construct($startDate, $endDate);
    }

    /**
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->year;
    }

    /**
     * Indica se o ano é bissexto
     * @return boolean
     */
    public function isLeapYear()
    {
        return iterator_count($this->getDatePeriod()) == 366;
    }

}
