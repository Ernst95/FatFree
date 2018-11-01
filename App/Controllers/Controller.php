<?php

class Controller {

    function beforeroute() {
        echo 'Before route - ';
    }

    function afterroute() {
        echo '- After route';
    }
    
}

?>