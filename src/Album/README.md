#Album module

This module provides modularity across all dependencies.

Requirements:
* MySQL
* Zend DB 
* Zend Hydrator 
* Zend Form 
* Zend Validator
* Zend Paginator
* Zend Translation

**Todo:**
- Apply zend service manager - DONE, currently on container->get()
- zend form - DONE
- zend  validator
- zend view templating
- applying child route in fastroute - currently there is no support on making a child route using the configuration driven routes, instead, we have to create our own RoutingFactory which we can feed some route configuration and apply some business logical that can achieve the goal of having a child route.