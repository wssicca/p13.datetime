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
 * Classe que representa uma semana segundo a definição ISO-8601. Nela,
 * as semanas começam nas segundas (dia 1) e terminam no domingo (dia 7).
 * 
 *
 * @author Wagner Sicca <wssicca@gmail.com>
 * @namespace p13\datetime
 * @package p13\datetime
 * @link http://pt.wikipedia.org/wiki/ISO_8601 Link com uma breve descrição
 */
class Week extends DateRange
{

    /**
     * Número da semana segundo o padrão ISO-8601
     * @var int
     */
    public $week;

    /**
     * Número do ano
     * @var int 
     */
    public $year;

    /**
     * 
     * @param int $week ISO-8601 week number of year, weeks starting on Monday
     * @param int $year
     */
    public function __construct($week, $year)
    {
        $this->week = (int) $week;
        $this->year = (int) $year;

        $startDate = new DateTime();
        $startDate->setISODate($this->year, $this->week);

        $endDate = clone $startDate;
        $endDate->add(DateInterval::createFromDateString('6 days'));

        parent::__construct($startDate, $endDate);
    }

    /**
     * Retorna uma representação textual da semana
     * @return string
     */
    public function __toString()
    {
        return sprintf(
                "Semana %d (%s a %s)", $this->week, $this->startDate->format('d/m/Y'), $this->endDate->format('d/m/Y')
        );
    }

    /**
     * Compara dois objetos Week. Retorna:
     * - um número menos que zero se o primeiro for menor que o segundo;
     * - um número maior que zero se o primeiro for maior que o segundo;
     * - zero se ambos forem iguais
     * @param \p13\datetime\Week $a
     * @param \p13\datetime\Week $b
     * @return int
     */
    public static function compare(Week $a, Week $b)
    {
        if ($a == $b) {
            return 0;
        } else if ($a->year == $b->year) {
            if ($a->week < $b->week) {
                return -1;
            } else if ($a->week > $b->week) {
                return 1;
            } else {
                return 0;
            }
        } else {
            if ($a->year < $b->year) {
                return -1;
            } else if ($a->year > $b->year) {
                return 1;
            } else {
                return 0;
            }
        }
    }

}
