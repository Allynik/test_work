<?php

namespace app\widgets\inputmask;

/**
 * Phone mask.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class Phone extends InputMask
{
    /**
     * Icon class.
     *
     * @var string
     */
    protected $iconClass = 'fas fa-phone';

    /**
     * Init widget.
     */
    public function init()
    {
        parent::init();

        $this->options['mask'] = '+7 999 999-99-99';
    }
}
