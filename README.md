# TODO-TevekenysegKezelo

This is my School project. Users can create their own Tasks, Activities.

Setup, config:
- After copying the files to the root of your web server, edit URL, Database, Path settings in /rest/configs/settings.php
- Import the Database structure from /rest/configs/adatbazis.sql

Checking database connection:
your-host.your-domain/rest/conninfo.php
If dbStatus is true, there is something wrong with the Database connection. Check if logging is enabled in /rest/configs/settings.php
  so, you can view the cause of error in /rest/logs/currentDate.log
