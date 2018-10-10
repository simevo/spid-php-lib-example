<?php 
$mapping = $sp->getIdpList();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="https://italia.github.io/spid-smart-button/img/favicon.ico">
    <link rel="stylesheet" href="https://italia.github.io/spid-smart-button/spid-button.min.css">
    <script src="https://italia.github.io/spid-smart-button/spid-button.min.js "></script>
    <title>Smart Button Login</title>
</head>
<body>
    <div id='spid-button' aria-live="polite">
        <noscript>
            To use the Spid Smart Button, please enable javascript!
        </noscript>
    </div>
    <ul>
      <li><a href="/acs">Attribute Consuming Service (acs)</a><br></li>
      <li><a href="/metadata">Metadata</a></li>
      <li><a href="/logout">Logout</a></li>
      <li><a href="/slo">Single Log Out (slo)</a></li>
    </ul>

    <script>
    var spid = SPID.init({
        lang: 'it',
        selector: '#spid-button',
        method: 'GET',
        url: '/login?idp={{idp}}', // to perform login with POST use: '/login-post?idp={{idp}}'
        mapping: {                    
            <?php 
            foreach ($mapping as $key => $value) {
                echo "'" . $value . "': '" . $key . "',";
            }
            ?>
        },
        supported: [
            <?php
            foreach ($mapping as $key => $value) {
                echo "'" . $value . "',";
            }
            ?>
        ],
        extraProviders: [           
            {
                "protocols": ["SAML"],
                "entityName": "Testenv",
                "logo": "spid-idp-dummy.svg",
                "entityID": "<?php echo IDP_ENTITYID; ?>",
                "active": true
            },
        ],
        protocol: "SAML",
        size: "large"
    });
    </script>
</body>
</html>
