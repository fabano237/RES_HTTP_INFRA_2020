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


        <Proxy balancer://cluster-static>
                # WebHead1
                BalancerMember "http://<?php print "$static_app1"?>""
                # WebHead2
                BalancerMember "http://<?php print "$static_app2"?>"
                # WebHead3
                BalancerMember "http://<?php print "$static_app3"?>"

                # Security "technically we aren't blocking
                # anyone but this is the place to make
                # those changes.
                Require all Granted
                # In this example all requests are allowed.

                # Load Balancer Settings
                # We will be configuring a simple Round
                # Robin style load balancer.  This means
                # that all webheads take an equal share of
                # of the load.
                ProxySet lbmethod=byrequests

        </Proxy>

        ProxyPass  "/"" "balancer://cluster-static:80/"
        ProxyPassReverse "/"" "balancer://cluster-static:80/"


        <Proxy balancer://cluster-dynamic>
                # WebHead1
                BalancerMember "http://<?php print "$dynamic_app1"?>"
                # WebHead2
                BalancerMember "http://<?php print "$dynamic_app2"?>"
                # WebHead3
                BalancerMember "http://<?php print "$dynamic_app3"?>"

                # Security "technically we aren't blocking
                # anyone but this is the place to make
                # those changes.
                Require all Granted
                # In this example all requests are allowed.

                # Load Balancer Settings
                # We will be configuring a simple Round
                # Robin style load balancer.  This means
                # that all webheads take an equal share of
                # of the load.
                ProxySet lbmethod=byrequests

        </Proxy>

        ProxyPass  "/api/students/" "balancer://cluster-dynamic:2020/"
        ProxyPassReverse "/api/students/" "balancer://cluster-dynamic:2020/"



        # balancer-manager
        # This tool is built into the mod_proxy_balancer
        # module and will allow you to do some simple
        # modifications to the balanced group via a gui
        # web interface.
        <Location /balancer-manager>
                SetHandler balancer-manager

                # I recommend locking this one down to your
                # your office
                Require host demo.res.ch

        </Location>

        ProxyPass /balancer-manager !

</VirtualHost>


