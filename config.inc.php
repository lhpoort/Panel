<?php
define("PBX_GATEWAY_UUID", "aaecc015-d58f-4783-bc9b-b7d0e1066fdf");
define("PBX_STAT_GROUPS", '{"aftersales": [211,212,213,214,215,216], "receptie": [200,201], "sales": [231,232,233,234,235,236], "algemeen": []}');
define("PBX_CACHE", 60);

//start the session
        if (function_exists('session_start')) {
                if (!isset($_SESSION)) {
                        session_start();
                }
        }

//regenerate sessions to avoid session id attacks such as session fixation
        if (array_key_exists('security',$_SESSION) && $_SESSION['security']['session_rotate']['boolean'] == "true") {
                $_SESSION['session']['last_activity'] = time();
                if (!isset($_SESSION['session']['created'])) {
                        $_SESSION['session']['created'] = time();
                } else if (time() - $_SESSION['session']['created'] > 28800) {
                        // session started more than 8 hours ago
                        session_regenerate_id(true);    // rotate the session id
                        $_SESSION['session']['created'] = time();  // update creation time
                }
        }

//set the domains session
        if (!isset($_SESSION['domains'])) {
                $domain = new domains();
                $domain->session();
                $domain->set();
        }

//set the domain_uuid variable from the session
        if (!empty($_SESSION["domain_uuid"])) {
                $domain_uuid = $_SESSION["domain_uuid"];
        }

?>
