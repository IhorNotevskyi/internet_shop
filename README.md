You need to enter your data in the file:<br>
/config/config.php<br>

Link to admin site: /admin/users/login<br>
Login: root<br>
Password: root1Q<br>

There may be a problem when starting from a localhost, it is related to the differences in MySQL versions, you need to do the following so that everything works fine:<br>
Log in:<br>
mysql -uroot -p<br>
And copy the following code:<br>
set global sql_mode = 'STRICT_TRANS_TABLES, NO_ZERO_IN_DATE, NO_ZERO_DATE, ERROR_FOR_DIVISION_BY_ZERO, NO_AUTO_CREATE_USER, NO_ENGINE_SUBSTITUTION';<br>
set session sql_mode = 'STRICT_TRANS_TABLES, NO_ZERO_IN_DATE, NO_ZERO_DATE, ERROR_FOR_DIVISION_BY_ZERO, NO_AUTO_CREATE_USER, NO_ENGINE_SUBSTITUTION';<br>

The main page in the "Top 3 active topics" displays the news in which the most comments have been posted in the last 24 hours, if nobody has commented on the last 24 hours, then nothing will be displayed in the "Top 3 active topics" (I am writing , for suddenly you will think that it does not work).<br>

Task in file: OOP_practice_task_2.doc
