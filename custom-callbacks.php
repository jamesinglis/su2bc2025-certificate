<?php

/*
 * Add any custom callbacks to this file
 */

/**
 * Formats a number as a currency amount with optional decimals
 *
 * @param string $input
 * @param array $url_argument
 * @return string
 */
function mutate_float_with_optional_decimals(string $input, array $url_argument): string
{
    if ($input == '') {
        return $input;
    }

    // If the amount is .00, omit it
    if (intval($input) == floatval($input)) {
        return number_format($input, 0, '.', ',');
    }

    return number_format(floatval($input), 2, '.', ',');
}

/**
 * Formats a number as a currency amount with no decimals
 *
 * @param string $input
 * @param array $url_argument
 * @return string
 */
function mutate_float_with_no_decimals(string $input, array $url_argument): string
{
    return number_format(floatval($input), 0, '.', ',');
}

/**
 * Capitalize the input
 *
 * @param string $input
 * @param array $url_argument
 * @return string
 */
function capitalize_input(string $input, array $url_argument): string
{
    return strtoupper($input);
}

/**
 * Ensure that the float is between 0 and 999999
 *
 * Note: 0 values return false
 *
 * @param string $input
 * @return bool
 */
function validate_float_under_999999_allow_zero(string $input): bool
{
    return floatval($input) < 999999 && floatval($input) >= 0;
}

/**
 * Custom mutation callback for a URL argument
 *
 * @param string $input
 * @param array $url_argument
 * @return string
 */
function mutate_to_uppercase(string $input, array $url_argument): string
{
    return strtoupper($input);
}

/**
 * Determine the certificate mode based on URL arguments
 *
 * @param array $url_arguments_array
 * @return string Returns 'steps-only', 'raised-only', or 'both'
 */
function event_mode(array $url_arguments_array): string
{
    if ($url_arguments_array['raised']['active'] == 0) {
        return 'steps-only';
    } elseif ($url_arguments_array['steps']['active'] == 0) {
        return 'raised-only';
    } else {
        return 'both';
    }
}

/**
 * Custom callback to get relative path to PDF template
 *
 * @param array $host_configuration_array
 * @param array $url_arguments_array
 * @return string Relative path to PDF template
 */
function event_pdf_template_callback(array $host_configuration_array, array $url_arguments_array): string
{
    return match (event_mode($url_arguments_array)) {
        'steps-only' => $host_configuration_array['pdf_template_steps_only'],
        'raised-only' => $host_configuration_array['pdf_template_raised_only'],
        default => $host_configuration_array['pdf_template'],
    };
}

/**
 * Custom callback to override the position of a text block
 *
 * @param array $text_block_position
 * @param array $text_block
 * @param array $url_arguments
 * @param string $host_name
 * @param array $host_configuration_array
 * @return array
 */
function event_raised_text_block_position_callback(array $text_block_position, array $text_block, array $url_arguments, string $host_name, array $host_configuration_array): array
{
    if (event_mode($url_arguments) === 'raised-only') {
        $text_block_position['x'] = 105;
    }
    return $text_block_position;
}

/**
 * Custom callback to determine whether or not a text block should show
 *
 * @param array $text_block
 * @param array $url_arguments
 * @param string $host_name
 * @param array $host_configuration_array
 * @return bool
 */
function event_raised_text_block_toggle_callback(array $text_block, array $url_arguments, string $host_name, array $host_configuration_array): bool
{
    return event_mode($url_arguments) !== 'steps-only';
}

/**
 * Custom callback to override the position of a text block
 *
 * @param array $text_block_position
 * @param array $text_block
 * @param array $url_arguments
 * @param string $host_name
 * @param array $host_configuration_array
 * @return array
 */
function event_steps_text_block_position_callback(array $text_block_position, array $text_block, array $url_arguments, string $host_name, array $host_configuration_array): array
{
    if (event_mode($url_arguments) === 'steps-only') {
        $text_block_position['x'] = 105;
    }
    return $text_block_position;
}

/**
 * Custom callback to determine whether or not a text block should show
 *
 * @param array $text_block
 * @param array $url_arguments
 * @param string $host_name
 * @param array $host_configuration_array
 * @return bool
 */
function event_steps_text_block_toggle_callback(array $text_block, array $url_arguments, string $host_name, array $host_configuration_array): bool
{
    return event_mode($url_arguments) !== 'raised-only';
}
