Baza studentów
============================

Aplikacja do zarządzania danymi studentów. Udostępnia REST API pozwajające odpytać o dane sudentów po numrze albumu, UIDzie z ELS lub wewnętrznym identyfikatorze studenta w bazie. 
Lista parametrów powinna byćzakodowana base64. Wymagana autoryzacja Basic Auth.

* GET: /api/students
* GET: /api/students/id/id
* GET: /api/students/card id/card uid
* GET: /api/students/album no/album no 

Dodatkowo można się zalogować do tej aplikacji, dodać nowych studenów (można wrzucić dane zbiorczo w pliku jako json) edytować/usunąć istniejących.

Dostęp do aplikacji: http://student-base-lb-1340981123.eu-central-1.elb.amazonaws.com/login
logowanie: adm@adm.com/123456

Format pliku:

[{
    "album_no": "100000",
    "name": "Dawid",
    "surname": "Szczyrk",
    "start_year": 12,
    "semester": 14,
    "card_uid": "11111110"
},
...]
