<?php
// ------------------------------------------------------------------------
function prx($array) {
    echo "<pre>";
    print_R($array);
    die;
}

function getQuotientAndRemainder($divisor, $dividend) {
    $quotient = (int)($divisor / $dividend);
    $remainder = $divisor % $dividend;
    return array( $quotient, $remainder );
}

// ------------------------------------------------------------------------
if (!function_exists('env')) {

    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null) {
        $value = isset($_ENV[$key]) ? $_ENV[$key] : $default;
        
        if ($value === false) {
            return $default;
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        if (($valueLength = strlen($value)) > 1 && $value[0] === '"' && $value[$valueLength - 1] === '"') {
            return substr($value, 1, -1);
        }

        return $value;
    }

}

// ------------------------------------------------------------------------
if (!function_exists('json_response')) {

    function json_response(array $array = [], $response_code = 200) {
        header('Content-Type: application/json');
        http_response_code($response_code);
        $return = empty($array) ? ['error' => true, 'message' => 'No Data.'] : $array;
        echo json_encode($return);
    }

}

// ------------------------------------------------------------------------
if (!function_exists('base_url')) {

    function base_url($segments = '') {
        $base = env('BASE_URL', '/');
        return $base . $segments;
    }

}

// ------------------------------------------------------------------------
if (!function_exists('uri_segments')) {

    function uri_segments($segment = null) {
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        if ($segment && is_numeric($segment)) {
            return isset($uriSegments[$segment]) && $uriSegments[$segment] != '' ? $uriSegments[$segment] : 'Invalid Segment';
        }

        return $uriSegments;
    }

}

// ------------------------------------------------------------------------
if (!function_exists('public_path')) {

    function public_path($path_to_dir = null) {
        return env('PUBLIC_PATH', '/') . $path_to_dir;
    }

}

