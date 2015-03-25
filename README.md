# Installation

1) Open application/config/database.php. Set the neccessary items there to connect to your database.

2) Open applicatin/config/migration.php. Set the following to TRUE

    $config['migration_enabled'] = TRUE;
    
3) On your browser, If your installing locally open

    http://localhost/<the app folder/install

If your installing on a server

    http://<your server address>/install
    
The will create all the db tables.

4) Open application/config/migration.php again. Then set the following to FALSE

    $config['migration_enabled'] = FALSE;
    
That's it.
