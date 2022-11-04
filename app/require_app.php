<?php
    //Require libraries from folder libraries
    // require_once 'libraries/Core.php';


    require_once __DIR__ . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'Core.php';

    require_once __DIR__ . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'Controller.php';

    require_once __DIR__ . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'Database.php';

    require_once __DIR__ . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'session_helper.php';

    require_once __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';


// exceptionnal code for more performances of update last seen
if (isLoggedIn()) {
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'update_last_seen.php';
}

    //Instantiate core class
    $init = new Core();
?>