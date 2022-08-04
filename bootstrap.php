<?php

// errors
error_reporting((E_ALL | E_STRICT) & ~E_DEPRECATED);
ini_set('html_errors', false);
ini_set('display_errors', true);
ini_set('display_startup_errors', false);
ini_set('log_errors', true);

// content-type
ini_set('default_mimetype', 'text/plain');
ini_set('default_charset', 'UTF-8');

// other
setlocale(LC_ALL, 'C');

// session
ini_set('session.use_cookies', true);
ini_set('session.auto_start', false);
ini_set('session.use_trans_sid', false);
ini_set('session.use_only_cookies', true);
ini_set('session.save_handler', 'files');

// multibyte string
ini_set('mbstring.language', 'neutral');
ini_set('mbstring.regex_encoding', 'UTF-8');
ini_set('mbstring.encoding_translation', true);
ini_set('mbstring.detect_order', 'auto');
ini_set('mbstring.substitute_character', 'none');
if ((int) ini_get('mbstring.func_overload') > 0) {
    exit("Set 'mbstring.func_overload' to '0' in php.ini.");
}

/**
 * Wrapper for Dotenv class object to cache it to static variable.
 *
 * @param string|null $config
 *
 * @return \Dotenv\Dotenv
 *
 * @throws Exception
 */
function dotenv($config = null)
{
    static $dotenv;

    if (null !== $config) {
        $dotenv = new Dotenv\Dotenv($config);
    }

    if (!$dotenv) {
        throw new \Exception("dotenv() helper is not initialized. Call dotenv('path to .env') first.");
    }

    return $dotenv;
}

/**
 * Gets the value of an environment variable. Supports boolean, empty and null.
 *
 * @param string $key
 * @param mixed  $default
 *
 * @return mixed
 */
function env($key, $default = null)
{
    if (array_key_exists($key, $_ENV)) {
        $value = $_ENV[$key];
    } elseif (array_key_exists($key, $_SERVER)) {
        $value = $_SERVER[$key];
    } else {
        $value = getenv($key);
    }
    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
        case 'null':
        case '(null)':
            return null;
        case 'empty':
        case '(empty)':
            return '';
    }

    return false === $value ? $default : $value; // switch getenv default to null
}
