<?php

function get_contact() {
    $CI = get_instance();
    return $CI->load->view('page/partials/_contact-modal', null, true);
}

switch ($vars['content-type']) {
    case "contact":
        echo get_contact();
    break;
}
?>