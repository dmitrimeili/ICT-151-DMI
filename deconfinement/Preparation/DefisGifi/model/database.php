<?php
/**
 * Created By PhpStorm
 * Date: 24.01.2020
 * Time: 16:55
 */

/**
 * Returns a PDO connection to the db
 * @return PDO
 */
function getPDO()
{
    require ".const.php";
    $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
    return $dbh;
}

/**
 * Selects one or many records
 * @param $query : the SQL query with (optional) PDO named parameters
 * @param $params : an associative array of key => value pairs with parameters values
 * @param $multirecord
 * @return array|mixed|null
 */
function select($query, $params, $multirecord)
{
    require ".const.php";
    $dbh = getPDO();
    try
    {
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute($params);//execute query
        if ($multirecord)
        {
            $queryResult = $statement->fetchAll(PDO::FETCH_ASSOC);
        } else
        {
            $queryResult = $statement->fetch(PDO::FETCH_ASSOC);
        }
        $dbh = null;
        if ($debug) var_dump($queryResult);
        return $queryResult;
    } catch (PDOException $e)
    {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function selectOne($query, $params)
{
    return select($query, $params, false);
}

function selectMany($query, $params)
{
    return select($query, $params, true);
}

/**
 * @param $query : the SQL query with (optional) PDO named parameters
 * @param $params : an associative array of key => value pairs with parameters values
 * @return int |null : the id of the record that was created
 */
function insert($query, $params)
{
    require ".const.php";
    $dbh = getPDO();
    try
    {
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute($params);//execute query
        return $dbh->lastInsertId();
    } catch (PDOException $e)
    {
        print "Error!: " . $e->getMessage() . "<br/>";
        $_SESSION['flashmessage'] = "Erreur lors de l'enregistrement";
        return null;
    }
}

/**
 * Executes a Delete or Update query
 * @param $query : the SQL query with (optional) PDO named parameters
 * @param $params : an associative array of key => value pairs with parameters values
 * @return bool|null
 */
function execute($query, $params)
{
    require ".const.php";
    $dbh = getPDO();
    try
    {
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute($params);//execute query
        $dbh = null;
        return true;
    } catch (PDOException $e)
    {
        print "Error!: " . $e->getMessage() . "<br/>";
        $_SESSION['flashmessage'] = "Erreur lors de l'enregistrement";
        return null;
    }
}

?>
