<?php
    function getTypesQuestions($question_type){
        // THIS FUNCTION CHECKS FOR EXISTANCE OF THE BY THE USER INSERTED E-MAILADDRESS

        $query = 'SELECT * FROM question_types';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':type', $question_type);
        $stmt->execute();
        
        if($stmt->rowCount() < 1){
            return true;
        }else{
            return false;
        }
    }
?>