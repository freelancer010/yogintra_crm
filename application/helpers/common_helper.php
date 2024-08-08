<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function getCurl($requestUrl,$inputData,$method)
{
    // $inputData['url'] = $requestUrl;
    $curlData = json_encode($inputData);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $requestUrl);
    curl_setopt($ch, CURLOPT_POST, $method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   // curl_setopt($ch, CURLOPT_POSTFIELDS, $curlData);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result,1);
}

//check auth
if (!function_exists('auth_check')) {
    function auth_check()
    {
        // Get a reference to the controller object
        $ci =& get_instance();
        if(!$ci->session->has_userdata('is_admin_login'))
        {
            redirect(PANELURL.'auth/login', 'refresh');
        }
    }
}
// check frenchisor
if (!function_exists('auth_user')) {
    function auth_user()
    {
        // Get a reference to the controller object
        $ci =& get_instance();
        if(!$ci->session->has_userdata('is_user_login'))
        {
            redirect(PANELURL.'auth/user_login', 'refresh');
        }
    }
}


if (!function_exists('front_css')) {
    function front_css()
    {
        return base_url()."assets/front/";
    }
}
