<?php
declare(strict_types=1);

namespace Pfort\Blog;

final class Helper
{
    public static function http404(): never {
        header("HTTP/1.1 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        exit;
    }
}