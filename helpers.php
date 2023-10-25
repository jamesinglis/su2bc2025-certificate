<?php

function load_config()
{
    if (file_exists(__DIR__ . '/config.json')) {
        $config = json_decode(file_get_contents(__DIR__ . '/config.json'), true);
    } else {
        die("Could not load configuration file.");
    }

    $config_override = array();
    if (file_exists(__DIR__ . '/config-override.json')) {
        $config_override = json_decode(file_get_contents(__DIR__ . '/config-override.json'), true);
    }

    return array_replace_recursive($config, $config_override);
}

function strip_accents($input)
{
    // Strip accents when the font can't handle it!
    $input = strtr(utf8_decode($input), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');

    return preg_replace("/[^\p{L}0-9., '\-()]+/", "", trim($input));
}