<?php

namespace App\Services;

include_once __DIR__ . '/../Helpers/all_inlcudes.php';

class messageService
{

    static function errorMesssage($msg)
    {
        echo '<div class="error">' . ' <h1> Error: ' . $msg . '</h1>' . '</div>';
    }
}
?>

<style>
    .error {
        color: red;
        text-align: center;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var error_msg = document.querySelectorAll('.error');

        if (error_msg.length > 0) {
            setTimeout(() => {
                window.history.back(); //redirect to the previous page
            }, 9000);
        } else {
            console.log("no error");
        }
    });
</script>
