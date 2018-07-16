You need to enter your data in the file:
/config/config.php

Link to admin site: /admin/users/login
Login: root
Password: root1Q

There may be a problem when starting from a localhost, it is related to the differences in MySQL versions, you need to do the following so that everything works fine:
Log in:
mysql -uroot -p
And copy the following code:
set global sql_mode = 'STRICT_TRANS_TABLES, NO_ZERO_IN_DATE, NO_ZERO_DATE, ERROR_FOR_DIVISION_BY_ZERO, NO_AUTO_CREATE_USER, NO_ENGINE_SUBSTITUTION';
set session sql_mode = 'STRICT_TRANS_TABLES, NO_ZERO_IN_DATE, NO_ZERO_DATE, ERROR_FOR_DIVISION_BY_ZERO, NO_AUTO_CREATE_USER, NO_ENGINE_SUBSTITUTION';

The main page in the "Top 3 active topics" displays the news in which the most comments have been posted in the last 24 hours, if nobody has commented on the last 24 hours, then nothing will be displayed in the "Top 3 active topics" (I am writing , for suddenly you will think that it does not work).

Task in file: OOP_practice_task_2.doc
