<?php
spl_autoload_register(function ($class_name) {
    $path_file = explode("_", $class_name);

    $file = $path_file[0] . DIRECTORY_SEPARATOR . $path_file[1] . ".php";
    require($file);
});
?>