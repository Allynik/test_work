<?php

namespace app\widgets\datetime;

/**
 * Time widget.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class Time extends DateTime
{
    /**
     * Date format.
     *
     * @var string
     */
    protected $format = 'HH:mm:ss';

    /**
     * Icon class.
     *
     * @var string
     */
    protected $iconClass = 'far fa-clock';
}
