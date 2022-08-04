<?php

namespace app\components;

use yii\base\InvalidCallException;

class ViewMacros extends \ArrayObject
{
    public function __construct($input = [], $flags = 0, $iterator_class = 'ArrayIterator')
    {
        $flags |= \ArrayObject::ARRAY_AS_PROPS;
        parent::__construct($input, $flags, $iterator_class);
    }

    public function __call($key, $args)
    {
        if (!is_callable($callback = $this->offsetGet($key))) {
            throw new InvalidCallException("Macros: `$key` is not subtype of type 'Closure'.");
        }

        return $this->renderCallback($callback, $args);
    }

    public function __invoke()
    {
        $args = func_get_args();
        $key = array_key_first($this->getArrayCopy());

        return $this->renderCallback([$this, $key], $args);
    }

    public function renderCallback($callback, $args = [])
    {
        $_obInitialLevel_ = ob_get_level();
        ob_start();
        ob_implicit_flush(false);

        try {
            $result = call_user_func_array($callback, $args);
            $render = trim(ob_get_clean());

            return $render ? $render : $result;
        } catch (\Exception $e) {
            while (ob_get_level() > $_obInitialLevel_) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }

            throw $e;
        } catch (\Throwable $e) {
            while (ob_get_level() > $_obInitialLevel_) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }

            throw $e;
        }
    }
}
