<?php
// Load Config
require_once __DIR__ . '/../app/config/config.php';

// Load Libraries
require_once __DIR__ . '/../app/helpers/session_helper.php';
require_once __DIR__ . '/../app/core/Core.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Database.php';

// Init Core Library
$init = new Core();
