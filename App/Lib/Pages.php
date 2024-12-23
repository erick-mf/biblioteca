<?php

namespace App\Lib;

class Pages
{
    /**
     * @param array<int,mixed> $params
     */
    public function render(string $page_name, array $params = null): void
    {
        if ($params != null) {
            foreach ($params as $name => $value) {
                $$name = $value;
            }
        }
        include_once "../App/views/layout/header.php";
        include_once "../App/views/$page_name.php";
        include_once "../App/views/layout/footer.php";
    }

}
