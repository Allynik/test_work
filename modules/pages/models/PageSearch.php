<?php

namespace app\modules\pages\models;

/**
 * Search page model.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class PageSearch extends Page
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['path'], 'string'],
            [['hidden'], 'boolean'],
            [['disabled'], 'boolean'],
        ];
    }
}
