<?php
require_once(__DIR__ . "/vendor/autoload.php");
require_once(__DIR__ . "/sp_conf/config.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

$base = SP_ENTITYID;
$settings = [
    'sp_entityid' => $base,
    'sp_key_file' => './sp_conf/sp.key',
    'sp_cert_file' => './sp_conf/sp.crt',
    'sp_assertionconsumerservice' => [
        $base . '/acs'
    ],
    'sp_singlelogoutservice' => [[$base . '/slo', '']],
    'sp_org_name' => 'test',
    'sp_org_display_name' => 'Test',
    'idp_metadata_folder' => './sp_conf/',
    'sp_attributeconsumingservice' => [
        ["name", "familyName", "fiscalNumber", "email"],
        ["name", "familyName", "fiscalNumber", "email", "spidCode"]
    ]
];
$sp = new Italia\Spid\Sp($settings);

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

switch ($request_uri[0]) {
    // Home page
    case '/':
        require './views/home.php';
        break;
    // Login page
    case '/login':
        require './views/login.php';
        break;
    // Login POST page
    case '/login-post':
        require './views/login_post.php';
        break;
    // Metadata page
    case '/metadata':
        require './views/metadata.php';
        break;
    // Acs page
    case '/acs':
        require './views/acs.php';
        break;
    // Logout page
    case '/logout':
        require './views/logout.php';
        break;
    // Logout POST page
    case '/logout-post':
        require './views/logout_post.php';
        break;
    // Slo page
    case '/slo':
        require './views/slo.php';
        break;
    // Everything else
    default:
        echo "404 not found";
        break;
}
