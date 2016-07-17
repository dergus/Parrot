<?php
    use dergus\fw\FW;

    require_once __DIR__.'/../../vendor/fzaninotto/faker/src/autoload.php';

    require_once __DIR__.'/../../fw/FW.php';

    FW::init(__DIR__.'/../config.php');

    $faker  = Faker\Factory::create();
    $db     = FW::getService('db');
    $sql    = "INSERT INTO reviews(name, email, msg, status, changed)
                      VALUES (?, ?, ?, 1, 0)";
    $db=$db->prepare($sql);
    for ($i = 0; $i < 50; $i++) {
        $db->execute([$faker->name,$faker->email,$faker->text]);
    }

    echo "ok";
