<?php

/**
 *checking validate field is empty or not
 *
 * @param $field_value
 * @param $field
 * @return bool
 */
function validate_field_not_empty($field_value, &$field): bool
{
    if (!trim($field_value)) {
        $field['error'] = 'The field is empty';
        return false;
    }

    return true;
}

/**
 * checking entered value is numeric
 * @param $field_value
 * @param $field
 * @return bool
 */
function validate_field_is_numeric($field_value, &$field): bool
{
    if (!is_numeric($field_value)) {
        $field['error'] = 'Laukelis turi buti skaicius';
        return false;
    }

    return true;
}

/**
 * check name has space between first and last names
 * @param $field_value
 * @param $field
 * @return bool
 */
function validate_field_name_has_space($field_value, &$field): bool
{
    if (!strpos(trim($field_value), " ")) {
        $field['error'] = 'Vardas ir pavardė turi būti atskirti tarpu';
        return false;
    } else {
        return true;
    }
}

/**
 * Validate field number range
 *
 * @param $field_value
 * @param array $field
 * @param array $params
 * @return bool
 */
function validate_field_range($field_value, array &$field, array $params): bool
{
    if ($field_value >= $params['min'] && $field_value <= $params['max']) {
        return true;
    } else {
        $field['error'] = "Netinkamas skaičius skaičius turi būti nuo {$params['min']} iki {$params['max']}";
        return false;
    }
}

/**
 * Validate field has upper case chars.
 *
 * @param $field_value
 * @param array $field
 * @return bool
 */
function validate_field_has_upper_case($field_value, array &$field): bool
{
    if (!preg_match('/[A-Z]/', $field_value)) {
        $field['error'] = "Slaptažodyje turi būti Didžioji raidė";
        return false;
    }

    return true;
}

/**
 * Validate fields length.
 *
 * @param $field_value
 * @param array $field
 * @param array $params
 * @return bool
 */
function validate_field_length($field_value, array &$field, array $params): bool
{
    if (isset($params['max']) && strlen($field_value) >= $params['max']) {
        $field['error'] = "Field must be no more than {$params['max']} characters";
        return false;
    }

    if (isset($params['min']) && strlen($field_value) <= $params['min']) {
        $field['error'] = "Field must be {$params['min']} characters or more";
        return false;
    }

    return true;
}

/**
 * Validate fields by match.
 *
 * @param array $filtered_input
 * @param array $form
 * @param array $params
 * @return bool
 */
function validate_fields_match(array $filtered_input, array &$form, array $params): bool
{
    foreach ($params as $field_id) {
        $reference_value = $reference_value ?? $filtered_input[$field_id];

        if ($reference_value !== $filtered_input[$field_id]) {
            $form['fields'][$field_id]['error'] = 'Fields not match!';

            return false;
        }
    }

    return true;
}

/**
 * Validate password check for match.
 *
 * @param array $filtered_input
 * @param array $form
 * @return bool
 */
function validate_login(array $filtered_input, array &$form): bool
{
    $user = App\App::$db->getRowWhere('users', ['email' => $filtered_input['email']]);
    if (!$user || !password_verify($filtered_input['password'], $user['password'])) {
        $form['fields']['password']['error'] = 'Neteisingas slaptažodis';
        return false;
    }

    return true;
}

/**
 * Check field for uniqueness
 *
 * @param array $form_values
 * @param array $form
 * @param array $params
 * @return bool
 */
function validate_field_unique(array $form_values, array &$form, array $params): bool
{
    $unique_field = $params['field'];
    $user = App\App::$db->getRowWhere('users', [$unique_field => $form_values[$unique_field]]);

    if ($user) {
        $form['fields'][$unique_field]['error'] = 'Field is not unique';
        return false;
    }

    return true;
}

/**
 * Checking the field for the contents of numbers
 *
 * @param $field_value
 * @param array $field
 * @return bool
 */
function validate_field_string($field_value, array &$field): bool
{
    if (preg_match('~[0-9]+~', $field_value)) {
        $field['error'] = 'Value can\'t contain a number';
        return false;
    }
    return true;
}

/**
 * Validate email.
 *
 * @param $field_value
 * @param array $field
 * @return bool
 */
function validate_email($field_value, array &$field): bool
{
    if (filter_var($field_value, FILTER_VALIDATE_EMAIL) == false) {
        $field['error'] = 'Email is not valid!';
        return false;
    }

    return true;
}
