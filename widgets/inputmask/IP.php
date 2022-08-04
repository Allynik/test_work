<?php

namespace app\widgets\inputmask;

/**
 * IP mask.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class IP extends InputMask
{
    /**
     * Icon class.
     *
     * @var string
     */
    protected $iconClass = 'fas fa-laptop';

    /**
     * Init widget.
     */
    public function init()
    {
        parent::init();

        $this->options['alias'] = 'ip';
    }
}
