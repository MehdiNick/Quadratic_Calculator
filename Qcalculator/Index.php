<html>

<head>


    <meta charset="UTF-8" />
    <style>
        <?php include "./style/calStyle.css" ?>
    </style>
</head>

<body>
    <!--&radic;<span style="text-decoration: overline">23 </span>
<br>
&radic;<span style="border-top: 1px black solid;">3 <sup>10</sup> </span>
-->

    <div>
        <ul>
            <li>Use the onscreen keyboard</li>
            <li>Make sure to close the parantheses</li>
        </ul>

    </div>
    <br>






    <div class="calculator-container">
        <div class="equation">

            <div class="coefficient-output" id="c1">
                <input type="hidden" id="c1In" name="c1" class="coef" value="">
                <input type="hidden" class="cLatex" id="c1latex" value="">

                <span class="cout"></span>

            </div>
            <span class="equation-span">x<sup>2</sup> + </span>
            <div class="coefficient-output" id="c2">
                <input type="hidden" id="c2In" name="c2" class="coef" value="">
                <input type="hidden" class="cLatex" id="c2latex" value="">

                <span class="cout"></span>
            </div>
            <span class="equation-span">x + </span>
            <div class="coefficient-output" id="c3">
                <input type="hidden" id="c3In" name="c3" class="coef" value="">
                <input type="hidden" class="cLatex" id="c3latex" value="">

                <span class="cout"></span>
            </div>
            <span class="equation-span">= 0</span>
        </div>



        <div class="calculator-row calculator-roww">

            <input type="button" name="" value="(" class="calculator-global open-parentheses ">
            <input type="button" name="" value=")" class="calculator-global close-parentheses">
            <input type="button" name="" value="&radic;" class="calculator-global operator" id="sqrt">
            <input type="button" name="" value="^" class="calculator-global operator" id="pow">

        </div>
        <div class="calculator-row calculator-roww">
            <input type="button" name="" value="7" class="calculator-global numbers">
            <input type="button" name="" value="8" class="calculator-global numbers">
            <input type="button" name="" value="9" class="calculator-global numbers">
            <input type="button" name="" value="/" class="calculator-global operator" id="division">
        </div>
        <div class="calculator-row calculator-roww">
            <input type="button" name="" value="4" class="calculator-global numbers">
            <input type="button" name="" value="5" class="calculator-global numbers">
            <input type="button" name="" value="6" class="calculator-global numbers">
            <input type="button" name="" id="multiplication" value="&times;" class="calculator-global operator">
        </div>
        <div class="calculator-row calculator-roww">
            <input type="button" name="" value="1" class="calculator-global numbers">
            <input type="button" name="" value="2" class="calculator-global numbers">
            <input type="button" name="" value="3" class="calculator-global numbers">
            <input type="button" name="" value="-" class="calculator-global operator">
        </div>
        <div class="calculator-row calculator-roww">

            <input type="button" name="" value="0" class="numbers calculator-big calculator-global ">
            <input type="button" name="" value="." class="calculator-global numbers">
            <input type="button" name="" value="+" class="calculator-global operator">

        </div>

        <div class="calculator-row" style="padding-top: 4px;">
            <input type="button" name="" value="C" class=" calculator-redd calculator-global white-text " id="Deleteall">
            <input type="button" name="" value="Del" class=" calculator-red calculator-global white-text " id="Deletethis">
            <input type="button" name="submit" value="=" class=" calculator-green white-text calculator-big " id="calcuResult">
        </div>




    </div>



    </div>
    <img id="loadingGif" src="./img/l.gif">
    <div class="equation-result visibilityHidden">
        <span class="Sol">Answer </span>
        <br>
        <br>
        <br>
        <div class="eqr">


        </div>




    </div>


</body>
<script src="./js/jquery-3.5.1.min.js"></script>
<script src="./js/calJS.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="./js/tex-mml-chtml.js"></script>



</html>