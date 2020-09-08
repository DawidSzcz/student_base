Baza studentów
============================

Aplikacja do zarządzania danymi studentów. Udostępnia REST API pozwajające odpytać o dane sudentów po numrze albumu, UIDzie z ELS lub wewnętrznym identyfikatorze studenta w bazie. 
Lista parametrów powinna byćzakodowana base64. Wymagana autoryzacja Basic Auth.

* GET: /api/students
* GET: /api/students/id/id
* GET: /api/students/card id/card uid
* GET: /api/students/album no/album no 

Dostęp do aplikacji: adm@adm.com/123456

Wykorzystana technologia:

* PHP7
* Symgfony4
* Bootstap3
* Doctrine
* https://github.com/lexik/LexikJWTAuthenticationBundle
* https://github.com/FriendsOfSymfony/FOSRestBundle

Dostęp do aplikacji: http://student-base-lb-1340981123.eu-central-1.elb.amazonaws.com/login
