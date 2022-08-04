<?php

namespace app\commands;

use app\helpers\ImageHelper;
use Yii;
use yii\console\{Controller, ExitCode};

class ClearThumbsController extends Controller
{
    public function actionIndex()
    {
        echo "Iterate thubms...\n";
        $appendIterator = new \AppendIterator();
        $appendIterator->append(ImageHelper::iterateThumbs('/assets'));
        $appendIterator->append(ImageHelper::iterateThumbs('/uploads'));

        $count = 0;
        foreach ($appendIterator as $fileInfo) {
            @unlink((string) $fileInfo);
            ++$count;
        }
        echo "Unlink $count thumbs complete.\n";

        return ExitCode::OK;
    }
}
