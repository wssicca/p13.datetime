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

/**
 * Classe que representa um mês segundo a definição ISO-8601. Nela,
 * as semanas começam nas segundas (dia 1) e terminam no domingo (dia 7).
 * 
 *
 * @author Wagner Sicca <wssicca@gmail.com>
 * @namespace p13\datetime
 * @package p13\datetime
 */
class Month extends DateRange
{

    /**
     * Indica o mês corrente
     * @const CURRENT_MONTH
     */
    const CURRENT_MONTH = 'CURRENT_MONTH';

    /**
     * Indica o ano corrente
     * @const CURRENT_YEAR
     */
    const CURRENT_YEAR = 'CURRENT_YEAR';

    /**
     * Número do mês
     * @var int
     */
    public $month;

    /**
     * Número do ano
     * @var int 
     */
    public $year;

    /**
     * 
     * @param int $month ISO-8601 week number of year, weeks starting on Monday
     * @param int $year
     */
    public function __construct($month = self::CURRENT_MONTH, $year = self::CURRENT_YEAR)
    {
        $this->month = $month == self::CURRENT_MONTH ? date('m') : $month;
        $this->year = $year == self::CURRENT_YEAR ? date('Y') : $year;

        $startDate = new Date();
        $startDate->setDate($this->year, $this->month, 1);

        $endDate = clone $startDate;
        $endDate->add(DateInterval::createFromDateString('1 month'));
        $endDate->sub(DateInterval::createFromDateString('1 day'));

        parent::__construct($startDate, $endDate);
    }

    /**
     * Retorna uma representação textual do mês no formato 'm/Y'
     * @return string
     */
    public function __toString()
    {
        return str_pad($this->month, 2, '0', STR_PAD_LEFT) . '/' . $this->year;
    }

    /**
     * Retorna uma instãncia de Month a partir de um número no formato YYYYMM
     * @param int $int
     * @return Month
     */
    public static function createFromInteger($int)
    {
        return new Month((int) mb_substr($int, 4), (int) mb_substr($int, 0, 4));
    }

    /**
     * Retorna um inteiro no formato Ym
     * @return int
     */
    public function getInt()
    {
        return (int) $this->year . str_pad($this->month, 2, '0', STR_PAD_LEFT);
    }

    /**
     * Retorna o objeto relativo ao quinto dia útil do mês 
     * @return Date
     */
    public function getQuintoDiaUtil()
    {
        $contadorDosDiasUteis = 0;
        $quintoDiaUtil = null;
        foreach ($this->getDatePeriod() as $data) {
            if ($data->format('N') < 6) {
                $contadorDosDiasUteis++;
            }
            if ($contadorDosDiasUteis == 5) {
                $quintoDiaUtil = Date::cast($data);
                break;
            }
        }
        return $quintoDiaUtil;
    }

    /**
     * Retorna um array com as semanas deste mês
     * @return \p13\datetime\Week[]
     */
    public function getWeeks()
    {
        $intervaloSemanal = DateInterval::createFromDateString('1 week');
        $dataFim = clone $this->endDate;
        $periodo = new DatePeriod($this->startDate, $intervaloSemanal, $dataFim);
        $semanas = array();
        foreach ($periodo as $dia) {
            $semanas[] = new Week($dia->format('W'), $dia->format('Y'));
        }
        return $semanas;
    }

}
