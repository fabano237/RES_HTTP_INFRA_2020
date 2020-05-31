<?php
    $static_app  = getenv('STATIC_APP');  
    $dynamic_app = getenv('DYNAMIC_APP');
?>
<VirtualHost *:80>
        ServerName demo.res.ch


        proxyPass '/api/students/' 'http://<?php print "$dynamic_app"?>/'
        proxyPassReverse '/api/students/' 'http://<?php print "$dynamic_app"?>/'


        proxyPass '/' 'http://<?php print "$static_app"?>/'
        proxyPassReverse '/' 'http://<?php print "$static_app"?>/'

</VirtualHost>
