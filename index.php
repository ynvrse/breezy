<?php
include("./core/Bootstrap.php");

route(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), __DIR__);
