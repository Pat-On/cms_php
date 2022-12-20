<?php

echo password_hash('secret', PASSWORD_BCRYPT, array('cost' => 10, 'salt' => "superSecretString"));

echo password_hash('secret', PASSWORD_BCRYPT, array('cost' => 10, 'salt' => "superSecretString"));



?>