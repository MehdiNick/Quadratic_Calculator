<?php
abstract class Equation{

    public $error;
    abstract public function answer();
    abstract public function bondAnswers($result);
    abstract public function isSetParam();
    abstract public function setParams();

    public function setErrorResponse($msg){
        $this->error=json_encode(array('status' => 403, 'msg' => "$msg"));
    }
    public function GetError(){
        return $this->error;
    }
}

class QuadraticEquation extends Equation
{
    private $c1;
    private $c2;
    private $c3;

    public function isSetParam()
    {
        if (isset($_POST["c1"]) && isset($_POST["c2"]) && isset($_POST["c3"]))
            return true;
        else
            return false;
    }

    public function setParams()
    {
        $pattern = "/^([0-9\(]|\bsqrt\b){1}([0-9\*\/\**\+\.\(\)]|\bsqrt\b)*$/";
        if (!preg_match($pattern, $_POST["c1"]) &&
            !preg_match($pattern, $_POST["c2"]) &&
            !preg_match($pattern, $_POST["c3"])) {
            $this->setErrorResponse(" لطفا ضرایب را چک کنید");
            return false;
        } else {
            try {
              $this->setErrorResponse($_POST["c1"]);
                $this->c1 = eval('return ' . $_POST["c1"] . ';');
                $this->c2 = eval('return ' . $_POST["c2"] . ';');
                $this->c3 = eval('return ' . $_POST["c3"] . ';');
            }
            catch (ParseError  $e){

               $this->setErrorResponse("ضرایب به درستی وارد نشده اند");
                return false;
            }
            if ($this->c1 == 0) {
                $this->setErrorResponse("ضریب x^2  نمی تواند صفر باشد");
                return false;
            }
            return true;
        }
    }


    public function answer()
    {
        $result=[];
        $b2Float = pow($this->c2,2);
        $fourAC = -4*$this->c1*$this->c3;
        $result[]= array("b"=>-($this->c2),"b2"=>$b2Float,"fourac"=>$fourAC,"twoa"=>2*$this->c1);
        $Delta = round($b2Float+$fourAC,4);

        if($Delta>0){

            $sqrtDelta = sqrt($Delta);
            if(!round($sqrtDelta)==$sqrtDelta){
                $result[]= array("b"=>-($this->c2),"floatdelta"=>$Delta,"twoa"=>2*$this->c1);
            }
            $result[]= array("b"=>-($this->c2),"sqrtdelta"=>$sqrtDelta,"twoa"=>2*$this->c1);
            $final= (-($this->c2)+$sqrtDelta / 2*$this->c1);
            $result[]= array("final"=>$final);
            $final= (-($this->c2)-$sqrtDelta / 2*$this->c1);
            $result[]= array("final"=>$final);
        }else if($Delta==0){
            $Delta=0;
            $result[]= array("b"=>-($this->c2),"sqrtdelta"=>$Delta,"twoa"=>2*$this->c1);
            $final= -($this->c2) / 2*$this->c1;
            $result[]= array("final"=>$final);
        }else{
            $this->setErrorResponse("این معادله جوابی ندارد زیرا دلتا کوچکتر از صفر است");
            return false;
        }
        $result= $this->bondAnswers($result);
        //print_r($result);
        return json_encode($result);
    }

    public function bondAnswers($result){
        $p=[];
        foreach ($result as $row) {
            if(count($row)==4) {
                $p[] = "\(\\frac{" . $row["b"] . '\pm\sqrt{' . round($row["b2"],2) . "-" . round(abs($row["fourac"]),2) . "}}{" .  round($row["twoa"],2) . "}\)";
                $p[] = "\(\\frac{" . $row["b"] . '\pm\sqrt{' . (round($row["b2"],2)-round(abs($row["fourac"]),2)) . "}}{" .  round($row["twoa"],2) . "}\)";
            }else if(count($row)==3){
                if(key_exists("floatdelta",$row)){
                    $p[] = "\(\\frac{".$row["b"] .'\pm\sqrt{'.round($row["floatdelta"],2)."}{". round($row["twoa"],2)."}\)";
                }else if(key_exists("sqrtdelta",$row)){
                    $p[] = "\(\\frac{".$row["b"] .'\pm    '.round($row["sqrtdelta"],2)."}{". round($row["twoa"],2)."}\)";
                }

            }else if(key_exists("final",$row)){
                static $xCounter = 1;
                $p[] = "\(x_".$xCounter." = ".round($row["final"],3)."\)";
                $xCounter++;
            }
        }
        return $p;
    }


}



?>