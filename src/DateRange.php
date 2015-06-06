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

use \DatePeriod;
use core\util\TypeConverter;

/**
 * Classe que representa um range de datas
 * 
 *
 * @author Wagner Sicca <wssicca@gmail.com>
 * @namespace p13\datetime
 * @package p13\datetime
 */
class DateRange
{

    /**
     * Data final da semana (domingo)
     * @var DateTime
     */
    public $endDate;

    /**
     * Data inicial da semana (segunda)
     * @var DateTime
     */
    public $startDate;

    /**
     * 
     * @param \p13\datetime\DateTime $startDate
     * @param \p13\datetime\DateTime $endDate
     */
    public function __construct($startDate, $endDate)
    {
        $this->startDate = is_object($startDate) ?
                $startDate : TypeConverter::stringToDateTime($startDate);
        $this->endDate = is_object($endDate) ?
                $endDate : TypeConverter::stringToDateTime($endDate);
    }

    /**
     * Retorna uma representação textual da semana
     * @return string
     */
    public function __toString()
    {
        return sprintf(
                "%s a %s", $this->startDate->format('d/m/Y'), $this->endDate->format('d/m/Y')
        );
    }

    /**
     * Retorna um objeto DatePeriod relacionado ao intervalo de datas
     * @return \DatePeriod
     */
    public function getDatePeriod()
    {
        $intervaloDiario = DateInterval::createFromDateString('1 day');
        $dataFim = clone $this->endDate;
        $dataFim->add($intervaloDiario);
        return new DatePeriod($this->startDate, $intervaloDiario, $dataFim);
    }

}
