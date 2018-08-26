<?php

    //include libraries
    include('kso_sqllib.php');

    function isMember($nickname, $pwd)
    {
        $membergroupid = 0;

        $bdd = connectToDB();
        $query = $bdd->prepare('select * from member where nickname =:n');
        $rec = $query->execute(array(
            'n'=>$nickname
        ));
        if ($rec = $query->fetch())
        {
            if (password_verify($pwd, $rec['password']))
            {
                $membergroupid = $rec['member_groups_id'];
            }
        }
        $query->closeCursor(); 

        return $membergroupid;
    }

    function registerMember($member)
    {
        addMembersGroup(5, 'visitor');
        if (!uniqMemberNickname(htmlspecialchars($member['nickname'])))
        {
            return 'le pseudo '.htmlspecialchars($member['nickname']).' n\'est pas disponible.';
        }
        else
        {
            $bdd = connectToDB();
            $fieldsAndValues = array();
            $andFieldsAndValues = array();
            $whereFieldAndValue = array();
            array_push($fieldsAndValues,array("nickname", htmlspecialchars($member['nickname'])));
            array_push($fieldsAndValues,array("password", password_hash($member['password'], PASSWORD_DEFAULT)));
            array_push($fieldsAndValues,array("email", htmlspecialchars($member['email'])));
            array_push($fieldsAndValues,array("member_groups_id", 5));
            $query = execWrittingQuerySecured($bdd, "insert", "member", $fieldsAndValues, $whereFieldAndValue, $andFieldsAndValues);            
            return '';
        }
    }

    function addMembersGroup($id, $name)
    {
        $bdd = connectToDB();
        $query = $bdd->query('select * from member_groups where id = 5');
        
        if (!($rec = $query->fetch()))
        {
            $query->closeCursor(); 
            $fieldsAndValues = array();
            $andFieldsAndValues = array();
            $whereFieldAndValue = array();
            array_push($fieldsAndValues,array("id", $id));
            array_push($fieldsAndValues,array("name", $name));
            $query = execWrittingQuerySecured($bdd, "insert", "member_groups", $fieldsAndValues, $whereFieldAndValue, $andFieldsAndValues);
        }
        else
        {
            $query->closeCursor(); 
        }
    }

    function uniqMemberNickname($membernickname)
    {
        $bdd = connectToDB();
        $query = $bdd->prepare('select * from member where nickname =:n');
        $rec = $query->execute(array(
            'n'=>$membernickname
        ));
        $uniq = (!($rec = $query->fetch()));
        $query->closeCursor(); 
        return $uniq;
    }

    function connectToDB()
    {
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
            $memberspacesql_connected = true;
        }
        catch (Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

        return $bdd;
    }
?>
