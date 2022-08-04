<?php
/**
 * @see http://www.yiiframework.com/
 *
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\widgets;

use yii\base\Widget;

/**
 * Spaceless widget removes whitespace characters between HTML tags. Whitespaces within HTML tags
 * or in a plain text are always left untouched.
 *
 * Usage example:
 *
 * ```php
 * <body>
 *     <?php Spaceless::begin(); ?>
 *         <div class="nav-bar">
 *             <!-- tags -->
 *         </div>
 *         <div class="content">
 *             <!-- tags -->
 *         </div>
 *     <?php Spaceless::end(); ?>
 * </body>
 * ```
 *
 * This example will generate the following HTML:
 *
 * ```html
 * <body>
 *     <div class="nav-bar"><!-- tags --></div><div class="content"><!-- tags --></div></body>
 * ```
 *
 * This method is not designed for content compression (you should use `gzip` output compression to
 * achieve it). Main intention is to strip out extra whitespace characters between HTML tags in order
 * to avoid browser rendering quirks in some circumstances (e.g. newlines between inline-block elements).
 *
 * Note, never use this method with `pre` or `textarea` tags. It's not that trivial to deal with such tags
 * as it may seem at first sight. For this case you should consider using
 * [HTML Tidy Project](http://tidy.sourceforge.net/) instead.
 *
 * @see http://tidy.sourceforge.net/
 *
 * @author resurtm <resurtm@gmail.com>
 *
 * @since 2.0
 */
class Spaceless extends Widget
{
    /**
     * Starts capturing an output to be cleaned from whitespace characters between HTML tags.
     */
    public function init()
    {
        parent::init();
        ob_start();
        ob_implicit_flush(false);
    }

    /**
     * Marks the end of content to be cleaned from whitespace characters between HTML tags.
     * Stops capturing an output and echoes cleaned result.
     */
    public function run()
    {
        echo self::compress(ob_get_clean());
    }

    public static function compress($string)
    {
        // Replace newlines, returns and tabs with spaces
        $string = preg_replace('/([\t ]*)\n([\t ]*)/', "\n", $string);
        $string = str_replace(["\r", "\n", "\t"], ' ', $string);
        // Replace multiple spaces with a single space
        $string = preg_replace('/(>)\s+/m', '$1 ', $string);
        $string = preg_replace('/\s+(<)/m', ' $1', $string);
        // Remove spaces that are followed by either > or <
        $string = preg_replace('/ (>)/', '$1', $string);
        // Remove spaces that are preceded by either > or <
        $string = preg_replace('/(<) /', '$1', $string);
        // Remove spaces that are between > and <
        $string = preg_replace('/(>)\s+(<)/', '> $2', $string);

        return $string;
    }
}
