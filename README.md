# This repository contains the source files, documentation, and sql (to create the app's tables), for the Membership and Accounting System final IT project. Our project is just underway, and is scheduled to be implemented in late April 2018. The latest committed changes will be found under the master branch.

Files that contain config parameters (not references or includes) that MAY need to be viewed/changed for implementation:
admin_add_new_members: $pdoConnect = new PDO("mysql:host=localhost;dbname=yokotasp_mas1","root","root");
index.php: $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  

Files that contain config parameters:
database.php
dbConfig.php
start.php