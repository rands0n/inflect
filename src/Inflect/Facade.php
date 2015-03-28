<?php

namespace Inflect;

/**
 * This is a helper class that allows the usag of the Inflect\Inflect trought
 * static calls
 *
 * @example
 *     // Calling Inflect::plurarize as if it was static
 *     Inflect\Facade::pluralize('pão')
 *
 * @package Inflect
 */
class Facade
{
    static $inflector;

    /**
     * Returns an instance of Inflect\Inflect
     *
     * @return Inflect
     */
    protected static function getInflector()
    {
        if (!self::$inflector) {
            self::$inflector = new Inflect;
        }

        return self::$inflector;
    }

    /**
     * Handle dynamic, static calls to the actual inflector instance
     *
     * @param  string  $method
     * @param  array   $args
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $instance = self::getInflector();

        switch (count($args))
        {
            case 0:
                return $instance->$method();

            case 1:
                return $instance->$method($args[0]);

            default:
                return call_user_func_array(array($instance, $method), $args);
        }
    }
}
