<?php

$default_host = array(
    "slug" => "",
    "default" => false,
    "active" => false,
    "pdf_template" => "",
    "pdf_template_callback" => "",
    "pdf_orientation" => "P",
    "validate_arguments_callback" => "",
    "url_base" => "http://www.google.com",
    "redirect_location" => "http://www.google.com",
);

$default_url_argument = array(
    "argument" => "",
    "type" => "string",
    "default" => "",
    "default_callback" => "",
    "sanitize_callback" => "",
    "validate_callback" => "",
    "validate_for_hosts" => [],
    "mutate_callback" => "trim",
);

$default_text_block = array(
    "text" => "",
    "text_template" => "standard",
    "toggle_callback" => "",
    "toggle_for_hosts" => [],
    "position" => array(
        "x" => 10,
        "y" => 10,
        "width" => 190,
        "height" => 20,
        "align" => "C"
    ),
    "fit_line" => false,
    "multicell" => true
);

$default_image_block = array(
    "source" => "https://via.placeholder.com/350x150",
    "image_block_callback" => "",
    "toggle_callback" => "",
    "source_callback" => "",
    "position_callback" => "",
    "position" => array(
        "x" => 10,
        "y" => 52,
        "width" => 190,
        "height" => 20
    )
);