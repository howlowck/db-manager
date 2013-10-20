db-manager
==========

Laravel Package for Database management easier.

- Lists all the tables in the database
- Lists all the columns of a table
- Get datatype of a column

## Install
1. Add in your composer.json `"howlowck/db-manager": "dev-master"`
2. Add in your `app/config/app.php` service provider:
`'Howlowck\DbmanagerL4\DbmanagerL4ServiceProvider'`
3. (optional) add the facade:
`'DbManager' => 'Howlowck\DbManager\Facades\DbManager',`

## Usage
(If you use the Facade: )

- `DbManager::listTables( [optional] $exclude )`
-- lists all the tables in your database, $exclude is an array that you want to exclude from the final result

- `DbManager::listColumns($table, [optional] $exclude)`
-- lists all the columns in the given table.

- `DbManager::getColumnType($table, $columnName)`
-- returns the type name of a column

(If you choose to only use the service provider)

`App::make('dbmanager')->listTables()` ...

