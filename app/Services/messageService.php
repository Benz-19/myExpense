<?php

namespace App\Services;

include_once __DIR__ . '/../Helpers/all_inlcudes.php';

class messageService
{

    static function errorMesssage($msg)
    {
        echo
        '<div class="error">
            <h1> Error: {$msg}
        </div>';
    }
}
?>

<script>
</script>;
