<?php
function skin_get_parameters() {
    if (file_exists("parameters.php")) {
        include "parameters.php";
    } else {
        trigger_error("skin_get_parameters&#40;&#41;: No parameters to get because parameters.php does not exist", E_USER_WARNING);
    } 
}
?>