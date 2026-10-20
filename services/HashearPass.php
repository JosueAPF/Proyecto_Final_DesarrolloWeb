<?php

 /*
          haseho de la contraseña del admin(quitar o usar de ejemplo)
                echo "password hash";
                echo "<br>";
                echo password_hash("Admin123", PASSWORD_DEFAULT);
                echo "<br>";

         */
      class HashearPass{
            public function Hashear(string $pass){
                  return password_hash($pass, PASSWORD_DEFAULT);
            }
      }

/*
      $newHash = new HashearPass();
      
      echo $newHash->Hashear("mango");
      */

?>