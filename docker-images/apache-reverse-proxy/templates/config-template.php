
<?php 
	$static_app1= getenv('STATIC_APP1');
	$static_app2 = getenv('STATIC_APP2');
	$static_app3 = getenv('STATIC_APP3');
	$dynamic_app1 = getenv('DYNAMIC_APP1');
        $dynamic_app2 = getenv('DYNAMIC_APP2');
        $dynamic_app3 = getenv('DYNAMIC_APP3');
        
?>

<VirtualHost *:80>
        ProxyRequests off

        ServerName demo.res.ch
        ServerAlias www.demo.res.ch

        <Location /balancer-manager>
                SetHandler balancer-manager
        </Location>

        ProxyPass /balancer-manager !

        <Proxy balancer://dynamic-cluster>
                # WebHead1
                BalancerMember 'http://<?php print "$dynamic_app1"?>'
                # WebHead2
                BalancerMember 'http://<?php print "$dynamic_app2"?>'
                # WebHead3
                BalancerMember 'http://<?php print "$dynamic_app3"?>'

                # Security "technically we aren't blocking
                # anyone but this is the place to make
                # those changes.
                Require all granted

                # Load Balancer Settings
                # We will be configuring a simple Round
                # Robin style load balancer.  This means
                # that all webheads take an equal share of
                # of the load.
                ProxySet lbmethod=byrequests
        </Proxy>
        # Point of Balance dynamic
        ProxyPass '/api/students/' 'balancer://dynamic-cluster/'
	ProxyPassReverse '/api/students/' 'balancer://dynamic-cluster/'
        
        # We do the same for the static cluster
        <Proxy balancer://static-cluster>
                # WebHead1
                BalancerMember 'http://<?php print "$static_app1"?>'
                # WebHead2
                BalancerMember 'http://<?php print "$static_app2"?>'
                # WebHead3
                BalancerMember 'http://<?php print "$static_app3"?>'

                # Security "technically we aren't blocking
                # anyone but this is the place to make
                # those changes.
                Require all Granted

                # Load Balancer Settings
                ProxySet lbmethod=byrequests
        </Proxy>
        # Point of Balance static
        ProxyPass  '/' 'balancer://static-cluster/'
	ProxyPassReverse '/' 'balancer://static-cluster/' 
        
  
</VirtualHost>




