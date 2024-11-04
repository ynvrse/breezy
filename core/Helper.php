<?php
function showToast()
{
    $message = $_SESSION['alert_message'] ?? null;
    $type = $_SESSION['alert_type'] ?? null;
    $icon = null;

    switch ($type) {
        case 'success':
            $icon = 'circle-check-big';
            break;
        case 'danger':
            $icon = 'badge-x';
            break;

        case 'info':
            $icon = 'info';
            break;

        default:
            $icon = 'circle-check-big';
            break;
    }



    $alertTypes = ['primary', 'secondary', 'success', 'warning', 'info', 'light', 'dark'];



    if (in_array($type, $alertTypes)) {
        $type = 'light';
    }

    $alertId = uniqid('alert_');


    if (isset($message)) {

        echo "<div id='$alertId' class='alert alert-$type alert-dismissible border-dark  fade show' role='alert'>
                <i data-lucide='$icon' class='me-2'></i> $message
            <button class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
        </div>";

        echo "<script>
            setTimeout(function () {
                var alertElement = document.getElementById('$alertId');
                if (alertElement) {
                    alertElement.classList.remove('show');

                    setTimeout(function () {
                        alertElement.remove();
                    }, 150)
                }
                 
            }, 2000)
        </script>";
    }

    closeToast();

}

function closeToast()
{
    unset($_SESSION['alert_message']);
    unset($_SESSION['alert_type']);
}

function Toast($message, $type = 'success')
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION['alert_message'] = $message;
    $_SESSION['alert_type'] = $type;

}


function getURI()
{
    return $_SERVER["REQUEST_URI"];
}
function getTitle()
{
    $title = explode('/', $_SERVER["REQUEST_URI"]);

    return ucwords($title[1]);
}

function user($key = 'id')
{
    $user = $_SESSION["users"];
    return $user[$key];
}




?>