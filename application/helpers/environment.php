<?php

if (substr($_SERVER['SERVER_NAME'], -strlen('.dev')) === '.dev' || strpos($_SERVER['SERVER_NAME'], 'xip.io') !== FALSE) {
    define('ENVIRONMENT', 'development');
} else if ($_SERVER['SERVER_NAME'] == 'uxtesting.wrayward.com') {
    define('ENVIRONMENT', 'staging');
} else {
    define('ENVIRONMENT', 'production');
}