<?php require('blogadmin/configs.php');?>

<?php

    if(isset($_POST)){

                $first_name  		=   $_POST['first_name'];
                $last_name  		=   $_POST['last_name'];
                $email 				=   $_POST['email'];
                $address  			=   $_POST['address'];
                $phone_number  		=   $_POST['phone_number'];
                $skill  			=   $_POST['skill'];


                     $sql = "INSERT INTO soft_skill(first_name, last_name, email, address, phone_number, skill ) VALUES(?,?,?,?,?,?)";
                     $stmtinsert = $db->prepare($sql);
                     $result = $stmtinsert->execute([$first_name, $last_name, $email, $address, $phone_number, $skill]);
                     if($result){
                         echo 'successfully Register.';
                     }else{
                         echo 'There were errors while saving the data.';
                     }
            }else{
                echo 'No data';
            }