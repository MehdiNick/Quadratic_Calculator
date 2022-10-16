<?php

require_once("./equation.php");
$equation = null;
if (isset($_POST["ec"])) {

    switch ($_POST["ec"]) {
        case "qu1":
            $equation = new QuadraticEquation();
            break;
    }

    if (!is_null($equation)) {
        if ($equation->isSetParam()) {
            if ($equation->setParams()) {
                $answer = $equation->answer();
                if ($answer != false) {
                    echo $answer;
                } else {
                    echo $equation->GetError();
                }
            } else {
                echo $equation->GetError();
            }
        } else {
            echo $equation->GetError();
        }
    }
}
