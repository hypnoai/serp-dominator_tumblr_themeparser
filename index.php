<?php
require './themer.php';

Themer::$theme_file = 'my_theme.html'; // the default is 'theme.html';

Themer::run(__DIR__);

?>