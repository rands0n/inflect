<?php

namespace Inflect;

class Inflect
{

    /**
     * Declare plural words in lowercase
     *
     * @var string
     **/
    static $plural = array(
        '/(s)$/i'                                           => '$1',
        '/^(paí)s$/i'                                       => '$1ses',
        '/(z|r)$/i'                                         => '$1es',
        '/al$/i'                                            => 'ais',
        '/el$/i'                                            => 'eis',
        '/ol$/i'                                            => 'ois',
        '/ul$/i'                                            => 'uis',
        '/([^aeou])il$/i'                                   => '$1is',
        '/m$/i'                                             => 'ns',
        '/^(japon|escoc|ingl|dinamarqu|fregu|portugu)ês$/i' => '$1eses',
        '/^(|g)ás$/i'                                       => '$1ases',
        '/ão$/i'                                            => 'ões',
        '/^(irm|m)ão$/i'                                    => '$1ãos',
        '/^(alem|c|p)ão$/i'                                 => '$1ães',
        '/ao$/i'                                            => 'oes',
        '/^(irm|m)ao$/i'                                    => '\1aos',
        '/^(alem|c|p)ao$/i'                                 => '\1aes',
        '/$/'                                               => 's',
    );

    /**
     * Declare singular words in lowercase
     *
     * @var string
     **/
    static $singular = array(
        '/([^ê])s$/i'                                        => '$1',
        '/^(á|gá|paí)s$/i'                                   => '$1s',
        '/(r|z)es$/i'                                        => '$1',
        '/([^p])ais$/i'                                      => '$1al',
        '/eis$/i'                                            => 'el',
        '/ois$/i'                                            => 'ol',
        '/uis$/i'                                            => 'ul',
        '/(r|t|f|v)is$/i'                                    => '$1il',
        '/ns$/i'                                             => 'm',
        '/sses$/i'                                           => 'sse',
        '/^(.*[^s]s)es$/i'                                   => '$1',
        '/ães$/i'                                            => 'ão',
        '/aes$/i'                                            => 'ao',
        '/ãos$/i'                                            => 'ão',
        '/aos$/i'                                            => 'ao',
        '/ões$/i'                                            => 'ão',
        '/oes$/i'                                            => 'ao',
        '/(japon|escoc|ingl|dinamarqu|fregu|portugu)eses$/i' => '$1ês',
        '/^(g|)ases$/i'                                      => '$1ás'
    );

    /**
     * Declare irregular word
     *
     * @var string
     **/
    static $irregular = array(
        'país' => 'países'
    );

    /**
     * Declare uncountable words
     *
     * @var string
     **/
    static $uncountable = array(
        'tórax',
        'tênis',
        'ônibus',
        'lápis',
        'fênix'
    );

    /**
     * Pluralize word
     *
     * @param string
     * @return string
     **/
    public static function pluralize($string)
    {
        if (in_array(strtolower($string), self::$uncountable)) {
            return $string;
        }

        foreach (self::$irregular as $pattern => $result) {
            $pattern = '/' . $pattern . '$/i';

            if (preg_match($pattern, $string)) {
                return preg_replace($pattern, $result, $string);
            }
        }

        foreach (self::$plural as $pattern => $result) {
            if (preg_match($pattern, $result)) {
                return preg_replace($pattern, $result, $string);
            }
        }

        return $string;
    }

    /**
     * Singularize word
     *
     * @param string
     * @return string
     **/
    public static function singularize($string)
    {
        if (in_array(strtolower($string), self::$uncountable)) {
            return $string;
        }

        foreach (self::$irregular as $result => $pattern) {
            $pattern = '/' . $pattern . '$/i';

            if (preg_match($pattern, $string)) {
                return preg_replace($pattern, $result, $string);
            }
        }

        foreach (self::$singular as $pattern => $result) {
            if (preg_match($pattern, $string)) {
                return preg_replace($pattern, $result, $string);
            }
        }

        return $string;
    }

    /**
     * Camelize word
     *
     * @param string
     * @return string
     **/
    public static function camelize($string, $uppercase_first_letter = false)
    {
        if ($uppercase_first_letter) {
            return str_replace(' ', '', ucwords(strtr($string, '_-', ' ')));
        }

        return str_replace(' ', '', lcfirst(strtr($string, '_-', ' ')));
    }

}
