<?php
    if (isset($_GET['page']) && $_GET['page'] == 'dispute'){
        require_once "dispute.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'all_disputes') {
        require_once "all_disputes.php";
    }
?>