<style>
    .error {
        color: red;
        text-align: center;
    }

    .success {
        color: lightgreen;
        text-align: center;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var error_msg = document.querySelectorAll('.error');
        var success_msg = document.querySelectorAll('.success');

        // Error message
        if (error_msg.length > 0) {
            setTimeout(() => {
                window.history.back(); //redirect to the previous page
            }, 9000);
        } else {
            console.log("no error");
        }

        // Success message
        if (success_msg.length > 0) {
            setTimeout(() => {
                window.history.back(); //redirect to the previous page
            }, 9000);
        } else {
            console.log("no error");
        }
    });
</script>

<?php

namespace App\Services;

include_once __DIR__ . '/../Helpers/all_inlcudes.php';

class messageService
{

    public static function errorMesssage($msg)
    {
        echo '<div class="error">' . ' <h1> Error: ' . $msg . '</h1>' . '</div>';
    }

    public static function successMessage($msg)
    {
        echo '<div class="success">' . ' <h1>' . $msg . '</h1>' . '</div>';
    }
}
?>


