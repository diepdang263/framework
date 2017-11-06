<?php

namespace App\Core;

class Error
{
    public static function collect($errno, $errstr, $errfile, $errline)
    {
        $error = [
            'code' => $errno,
            'message' => $errstr,
            'file' => $errfile,
            'line' => $errline
        ];

        self::display($error);
    }

    public static function display($error)
    {
        $errtype = self::mapCode($error['code']);

        self::fileLog($error);
        if (Config::read('App.AppNotification.Error') == true) {
            self::sendMail($error);
        }

        if (Config::read('App.Debug') == true) {
            print "<div style='text-align: left;'>";
            print "<h2 style='color: rgb(190, 50, 50);'>Error Occurred:</h2>";
            print "<table style='width: 800px; display: inline-block;'>";
            print "<tr style='background-color:rgb(230,230,230);'><th style='width: 80px;'>Type</th><td>" . $errtype . "</td></tr>";
            print "<tr style='background-color:rgb(240,240,240);'><th>Message</th><td>{$error['message']}</td></tr>";
            print "<tr style='background-color:rgb(230,230,230);'><th>File</th><td>{$error['file']}</td></tr>";
            print "<tr style='background-color:rgb(240,240,240);'><th>Line</th><td>{$error['line']}</td></tr>";
            print "</table></div>";
        } elseif ($errtype != 'Warning' && $errtype != 'Notice') {
            echo 'Error';
            exit();
        }
    }

    protected static function mapCode($code)
    {
        switch ($code) {
            case E_PARSE:
            case E_ERROR:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_USER_ERROR:
                $error = 'Fatal Error';
                break;
            case E_WARNING:
            case E_USER_WARNING:
            case E_COMPILE_WARNING:
            case E_RECOVERABLE_ERROR:
                $error = 'Warning';
                break;
            case E_NOTICE:
            case E_USER_NOTICE:
                $error = 'Notice';
                break;
            case E_STRICT:
                $error = 'Strict';
                break;
            case E_DEPRECATED:
            case E_USER_DEPRECATED:
                $error = 'Deprecated';
                break;
            default :
                $error = 'Unknown error (' . $code . ')';
                break;
        }

        return $error;
    }

    protected static function fileLog($error)
    {
        $content = '[' . self::mapCode($error['code']) . '] ' . $error['message'] . ' in [' . $error['file'] . ', line ' . $error['line'] . ']' . PHP_EOL;
        $content .= 'Request URL: ' . $_SERVER['REQUEST_URI'] . PHP_EOL;
        if (!empty($_SERVER['HTTP_REFERER']))
            $content .= 'Referer URL: ' . $_SERVER['HTTP_REFERER'] . PHP_EOL;
        if (!empty($_SERVER['REMOTE_ADDR']))
            $content .= 'Client IP: ' . $_SERVER['REMOTE_ADDR'] . PHP_EOL;

        Log::write('error', $content);
    }

    protected static function sendMail($error)
    {

    }
}
