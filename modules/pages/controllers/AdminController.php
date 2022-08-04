<?php

namespace app\modules\pages\controllers;

use app\modules\admin\controllers\AbstractCRUDController;
use app\modules\pages\models\{Page, PageSearch};

/**
 * Pages admin controller.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class AdminController extends AbstractCRUDController
{
    /**
     * Page size.
     *
     * @var int
     */
    protected $pageSize = 0;

    /**
     * Model class.
     *
     * @var ActiveRecord
     */
    protected $modelClass = Page::class;

    /**
     * Model search class.
     *
     * @var ActiveRecord
     */
    protected $modelSearchClass = PageSearch::class;

    /**
     * Order default.
     *
     * @var array
     */
    protected $defaultOrder = ['priority' => SORT_DESC, 'id' => SORT_DESC];
}
