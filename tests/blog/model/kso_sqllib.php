<?php 
    function execWrittingQuerySecured($bdd, $action, $tableName, $fieldsAndValues, $whereFieldAndValue, $andFieldsAndValues){
        //il faudrait gérer les ORDER BY, GROUP BY etc...
        //il faudrait gérer les date et formats:
        // SELECT DAY(field) AS dayf, HOUR(field) AS hourf FROM...
        //SELECT DATE_FORMAT(field, '%d/%m/%Y %Hh%imin%ss') AS formated_date FROM...
        //il faudrait gérer le select
        //il faudrait gérer les jointures???
        
        $query = "";
        
        $fieldsAndValuesCount = count($fieldsAndValues);
        $whereFieldAndValueCount = count($whereFieldAndValue);
        $andFieldsAndValuesCount = count($andFieldsAndValues);

        $nbOfRecProcessed = 0;

        //fill an array with keys, with fields and values
        $paramAndValues = array();
        for ($i = 0; $i < $fieldsAndValuesCount; $i++)
        {
            $paramAndValues[$fieldsAndValues[$i][0]] = $fieldsAndValues[$i][1];
        }

        if ($action == "insert")
        {
            $query = 'insert into '.$tableName.'(';
            //fields
            for ($i = 0; $i < $fieldsAndValuesCount; $i ++)
            {
                if (($i + 1) == $fieldsAndValuesCount)
                {
                    $query = $query.' '.$fieldsAndValues[$i][0].') values(';
                }
                else
                {
                    $query = $query.' '.$fieldsAndValues[$i][0].',';
                }
            }
            //values as param :fieldname to prepare and protect query from sqli
            for ($i = 0; $i < $fieldsAndValuesCount; $i++)
            {
                if (($i + 1) == $fieldsAndValuesCount)
                {
                    $query = $query.' :'.$fieldsAndValues[$i][0].')';
                }
                else
                {
                    $query = $query.' :'.$fieldsAndValues[$i][0].',';
                }
            }
        }
        else 
        if ($action == "update")
        {
            $query = 'update '.$tableName.' set ';
            //fields and values as param :fieldname to prepare and protect query from sqli
            for ($i = 0; $i < $fieldsAndValuesCount; $i ++)
            {
                if (($i + 1) == $fieldsAndValuesCount)
                {
                    $query = $query.' '.$fieldsAndValues[$i][0].'=:'.$fieldsAndValues[$i][0];
                }
                else
                {
                    $query = $query.' '.$fieldsAndValues[$i][0].'=:'.$fieldsAndValues[$i][0].',';
                }
            }

        }
        else
        if ($action == "delete")
        {
            $query = 'delete from '.$tableName;

        }
        //manage WHERE
        if ($whereFieldAndValueCount != 0)
        {
            //add field and value to array with keys
            $paramAndValues['w'.$whereFieldAndValue[0][0]] = $whereFieldAndValue[0][1];
            //update query
            $query = $query.' where '.$whereFieldAndValue[0][0].'=:w'.$whereFieldAndValue[0][0];
        }
        //manage AND
        if ($andFieldsAndValuesCount != 0)
        {
            for ($i = 0; $i < $andFieldsAndValuesCount; $i++)
            {
                //add fields and values to array with keys
                $paramAndValues['a'.$andFieldsAndValues[$i][0]] = $andFieldsAndValues[$i][1];
                //update query
                $query = $query.' and '.$andFieldsAndValues[$i][0].'=:a'.$andFieldsAndValues[$i][0];
            }
        }

        //prepare request
        $req = $bdd->prepare($query);

        //execute using param and values
        $nbOfRecProcessed = $req->execute($paramAndValues) or die(print_r($bdd->errorInfo()));

        //close request
        $req->closeCursor();

        //return nb of rec processed (works??)
        return $nbOfRecProcessed;

        //for test, return query
        //throw new Exception($query.' called with params: '.print_r($paramAndValues));
    }

    /* HOW TO CALL FUNCTION execWrittingQuerySecured():
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
    }
    catch (Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    
    $fieldsAndValues = array();
    $andFieldsAndValues = array();
    $whereFieldAndValue = array();
    
    array_push($fieldsAndValues,array("nickname", $nickname));
    array_push($fieldsAndValues,array("message", $message));
    array_push($whereFieldAndValue,array("nickname","saucisse"));
    array_push($andFieldsAndValues,array("message","test modification via ma library"));

    $query = execWrittingQuerySecured($bdd, "update", "simple_chat", $fieldsAndValues, $whereFieldAndValue, $andFieldsAndValues);
    echo $query;
    
    */


?>