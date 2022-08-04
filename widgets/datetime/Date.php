<?php

namespace app\widgets\datetime;

/**
 * Date widget.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class Date extends DateTime
{
    /**
     * Date format.
     *
     * @var string
     */
    protected $format = 'YYYY-MM-DD';

    /**
     * Icon class.
     *
     * @var string
     */
    protected $iconClass = 'far fa-calendar';
}
