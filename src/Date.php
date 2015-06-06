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

use \DateTimeZone;

/**
 * Extensão da classe DateTime que possui métodos 
 * relacionados somente à data, ignorando o tempo
 *
 * @author Wagner Sicca <wssicca@gmail.com>
 * @namespace p13\datetime
 * @package p13\datetime
 */
class Date extends DateTime implements ExtensionInterface
{

    /**
     * Retorna a data no formato d/m/Y
     * @return string
     */
    public function __toString()
    {
        return $this->format('br');
    }

    /**
     * Faz o "cast" de \DateTime para p13\datetime\Date
     * @param \DateTime $date
     * @return Date
     */
    public static function cast($date)
    {
        return $date instanceof self ?
                $date :
                new self($date->format(self::ISO8601), $date->getTimezone());
    }

    /**
     * Returns new DateTime object formatted according to the specified format
     * @param string $format
     * @param string $time
     * @param \DateTimeZone $object
     * @return Date
     * @static
     */
    public static function createFromFormat($format, $time, $object = null)
    {
        if (empty($object)) {
            $object = new DateTimeZone('America/Sao_Paulo');
        }
        return self::cast(parent::createFromFormat($format, $time, $object));
    }

    /**
     * Estende  a função DateTime::format() adicionando dois novos formatos:
     * - 'br' imprime a data no formato "d/m/Y"
     * - 'br_extenso' imprime a data no formato "1 de abril de 2015" (ABNT NBR 5892)
     * Demais casos serão passados para a função original
     * @param string $format
     */
    public function format($format)
    {
        $formato_br = 'br';
        $formato_br_extenso = 'br\\_extenso';

        if (
                preg_match("/{$formato_br}/", $format) == 0 ||
                preg_match("/\\\\{$formato_br}/", $format) == 1
        ) {
            return parent::format($format);
        } else if (preg_match("/{$formato_br_extenso}/", $format)) {
            setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
            date_default_timezone_set('America/Sao_Paulo');
            return preg_replace(
                    "/{$formato_br_extenso}/", strftime('%d de %B de %Y', $this->getTimestamp()), $format
            );
        } else {
            return parent::format('d/m/Y');
        }
    }

}
