<?php


namespace Service;

class Message
{
    public static function info(string $message): string
    {
        return "\033[0;32m -> ".$message." :-) \033[0m".PHP_EOL;
    }

    public static function error(string $message): string
    {
        return "\033[0;31m -> ".$message." :-( \033[0m".PHP_EOL;
    }

    public static function showWithTitle(string $title, string $message): string
    {
        return '* '.$title.PHP_EOL.$message;
    }
}
