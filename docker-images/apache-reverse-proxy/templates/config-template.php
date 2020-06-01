<?php
    $dynamic_app1 = getenv('DYNAMIC_APP1');  
    $dynamic_app2 = getenv('DYNAMIC_APP2');
    $dynamic_app3 = getenv('DYNAMIC_APP3');
    $static_app1  = getenv('STATIC_APP1');
    $static_app2  = getenv('STATIC_APP2');
    $static_app3  = getenv('STATIC_APP3');
?>
<VirtualHost *:80>
        ServerName demo.res.ch


        # balancer-manager
        # This tool is built into the mod_proxy_balancer
        # module and will allow you to do some simple
        # modifications to the balanced group via a gui
        # web interface.
        <Location /balancer-manager>
                SetHandler balancer-manager

        </Location>

        ProxyPass /balancer-manager !


        <Proxy balancer://cluster-static>
                # WebHead1
                BalancerMember "http://<?php print "$static_app1"?>"
                # WebHead2
                BalancerMember "http://<?php print "$static_app2"?>"
                # WebHead3
                BalancerMember "http://<?php print "$static_app3"?>"

                Require all Granted
                # In this example all requests are allowed.

                ProxySet lbmethod=byrequests

        </Proxy>

        ProxyPass  "/" "balancer://cluster-static/"
        ProxyPassReverse "/" "balancer://cluster-static/"


        <Proxy balancer://cluster-dynamic>
                # WebHead1
                BalancerMember 'http://<?php print "$dynamic_app1"?>'
                # WebHead2
                BalancerMember "http://<?php print "$dynamic_app2"?>"
                # WebHead3
                BalancerMember "http://<?php print "$dynamic_app3"?>"

                Require all Granted
                # In this example all requests are allowed.

               
                ProxySet lbmethod=byrequests

        </Proxy>

        ProxyPass  "/api/students/" "balancer://cluster-dynamic/"
        ProxyPassReverse "/api/students/" "balancer://cluster-dynamic/"


</VirtualHost>


