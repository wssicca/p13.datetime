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

use \DateTime as OriginalDateTime;

/**
 * Extensão da classe nativa \DateTime
 * 
 * @author Wagner Sicca <wssicca@gmail.com>
 * @namespace p13\datetime
 * @package p13\datetime
 */
class DateTime extends OriginalDateTime implements ExtensionInterface
{

    /**
     * Define o formato de data aceito pelo PostgreSQL
     * @const string
     */
    const PGSQL_DATE = 'Y-m-d';

    /**
     * Define o formato de timestamp aceito pelo PostgreSQL
     * @const string
     */
    const PGSQL_DATETIME = 'Y-m-d H:i:s';

    /**
     * Define o formato de hora aceito pelo PostgreSQL
     * @const string
     */
    const PGSQL_TIME = 'H:i:s';

    /**
     * Retorna o objeto Month relativo a esta data
     * @return \p13\datetime\Month
     */
    public function getMonth()
    {
        return new Month($this->format('m'), $this->format('Y'));
    }

    /**
     * Fim de Semana (Rick & Renner)
     * 
     * Do jeito que você me olha 
     * Você me fascina
     * Eu fico louco pôr você
     * E esse amor me domina
     * Podemos sair pôr aí 
     * Fazer um programa legal
     * E o fim de semana curtir
     * Que tal? Que tal?
     * Chega mais perto de mim
     * Mais perto do meu coração
     * Se tudo der certo assim
     * Que bom, que bom
     * 
     * Do jeito que você me olha
     * Você não me engana
     * Quem sabe a gente se encontra
     * E a gente se ama
     * Podemos sair pôr aí 
     * Fazer um programa legal
     * E o fim de semana curtir
     * Que tal? Que tal?
     * Chega mais perto de mim
     * Mais perto do meu coração
     * Se tudo der certo assim
     * Que bom, que bom
     * 
     * @return boolean
     */
    public function isFinalDeSemana()
    {
        return $this->format('N') > 5;
    }

    /**
     * Faz o "cast" de \DateTime para p13\util\datetime\DateTime
     * @param OriginalDateTime $datetime
     * @return DateTime
     */
    public static function cast($datetime)
    {
        return $datetime instanceof self ?
                $datetime :
                new self($datetime->format(self::ISO8601), $datetime->getTimezone());
    }

}
