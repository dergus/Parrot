<?php
    return [

        'basePath'=>__DIR__,
        'test'=>'tesst',
        'services'=>[
            'db'=>function($args){
                try {
                    $dsn='mysql:host=localhost;dbname=reviews';
                    $user='sqladmin';
                    $pass='sqlpass';
                    $dbh = new PDO($dsn, $user, $pass);

                    return $dbh;

                } catch (PDOException $e) {
                    print "Error!: " . $e->getMessage() . "<br/>";
                    die();
                }
            }

        ]


    ];