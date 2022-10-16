
function LatexFixBraces($openedBraces, $c1) {

    $length = $openedBraces.length;
    //alert($length);
    $latex = "";
    if ($length > 0) {
        $latex = "\\(" + $c1;
        var i;
        for (i = 0; i < $length; i++) {
            $latex += $openedBraces[i];
        }
        $latex += "\\)";
        //alert("here is latex "+$latex);
    } else {

        $latex = ("\\(" + $c1 + "\\)");

    }
    return $latex;
}


function inputNumbers($xc) {

    var $c1 = $xc.children(".cLatex").first().val();
    var $c2 = $xc.children(".coef").first().val();

    var $Latex = "";
    var $openedBraces = [];
    //alert($xc.attr("id"));
    // console.log("in");

    $(".numbers").click(function () {


        $c1 = $c1 + $(this).attr("value");


        $Latex = LatexFixBraces($openedBraces, $c1);
        $xc.children(".cLatex").first().val($c1);
        $xc.children(".cout").first().html($Latex);
        $c2 += $(this).attr("value");
        $xc.children(".coef").first().val($c2);

        //   console.log($xc.children("input").val());
    });
    //---------------------------------------
    $(".operator").click(function () {

        if ($(this).attr("id") == "sqrt") {

            $c1 = $c1 + "\\sqrt{(";
            $openedBraces.push("}");

            $c2 += "sqrt(";


        } else if ($(this).attr("id") == "pow") {

            $c1 = $c1 + "^{(";
            $openedBraces.push("}");

            $c2 += "**(";

        } else if ($(this).attr("id") == "multiplication") {
            $c1 = $c1 + "\\times";
            $c2 += "*";

        } else {
            $c1 = $c1 + $(this).attr("value");

            $c2 += $(this).attr("value");

        }

        $Latex = LatexFixBraces($openedBraces, $c1);

        $xc.children(".cLatex").first().val($c1);
        $xc.children(".cout").first().html($Latex);
        $xc.children(".coef").first().val($c2);

        //console.log($xc.children("input").val());


    });
    //-------------------------------------------
    $(".open-parentheses").click(function () {


        $c1 = $c1 + "(";

        $Latex = LatexFixBraces($openedBraces, $c1);

        //alert("c1 = "+$c1+" \n Latex= "+$Latex);
        $xc.children(".cLatex").first().val($c1);
        $xc.children(".cout").first().html($Latex);

        $c2 += "(";
        $xc.children(".coef").first().val($c2);
    });

    $(".close-parentheses").click(function () {
        $c1 += ")";
        if ($openedBraces.length > 0) {

            $c1 += $openedBraces[$openedBraces.length - 1];

            $openedBraces.pop();
            $Latex = LatexFixBraces($openedBraces, $c1);

        }


        $Latex = LatexFixBraces($openedBraces, $c1);


        $xc.children(".cLatex").first().val($c1);
        $xc.children(".cout").first().html($Latex);

        $c2 += ")";
        $xc.children(".coef").first().val($c2);



    });



    $("#Deletethis").click(function () {
        $c1 = "";
        $Latex = "";
        $xc.children(".cLatex").first().val($c1);
        $xc.children(".cout").first().html($c1);

        $c2 = "";
        $xc.children(".coef").first().val($c2);

    });




}



$("#Deleteall").click(function () {
    $(".cLatex").val("");
    $(".coef").val("");
    $(".cout").html("");

});




$(".coefficient-output").click(function () {

    //   console.log("l");
    //var $i=0;
    var idd = $(this).attr("id");
    if (idd == "c1") {
        //alert($i);
        $(".calculator-roww").children().unbind();
        $(".left").children().not("#calcuResult").unbind();
        $("#Deletethis").unbind();
        $("#c1In").focus();
        $("#c1In").trigger("focus");

    } else if (idd == "c2") {
        $(".calculator-roww").children().unbind();
        $(".left").children().not("#calcuResult").unbind();
        $("#Deletethis").unbind();
        $("#c2In").focus();
        $("#c2In").trigger("focus");

    } else {
        $(".calculator-roww").children().unbind();
        $(".left").children().not("#calcuResult").unbind();
        $("#Deletethis").unbind();
        $("#c3In").focus();
        $("#c3In").trigger("focus");

    }
    inputNumbers($(this), true);
    $(this).css('border-color', 'gray');
    $(this).css('cursor', 'text');
    $(this).siblings(".coefficient-output").css('border-color', 'lightgray');
    $(this).siblings(".coefficient-output").css('cursor', 'auto');



});


$("#calcuResult").click(function () {

    var $c1In = $("#c1In").val();
    var $c2In = $("#c2In").val();
    var $c3In = $("#c3In").val();

    if (($.trim($c1In) != "" && $.trim($c2In) != "" && $.trim($c3In) != "")) {


        $.ajax({
            url: './App/calculator1.php',
            type: 'post',
            dataType: 'JSON',
            data: { ec: "qu1", c1: $c1In, c2: $c2In, c3: $c3In },
            success: function (response) {
                $(".eqr").html("");
                $(".equation-result").addClass("visibilityHidden");

                if (response.status == 403) {

                    alert(response.msg);
                } else {


                    $a = $("#c1latex").val();
                    $b = $("#c2latex").val();
                    $c = $("#c3latex").val();

                    /*$("#c1In").val("");
                    $("#c2In").val("");
                    $("#c3In").val("");
                    $(".cLatex").val("");
                    $(".cout").html("");*/

                    $(".eqr").append("<p class='abc'>a=\\(" + $a + ",b=" + $b + ", c=" + $c + "\\)</p>");
                    $(".eqr").append("<p>\\(\\frac{-b\\pm\\sqrt{b^2-4ac}}{2a}\\)</p>");
                    $(".equation-result").removeClass("visibilityHidden");
                    MathJax.typeset();

                    var i;
                    //alert(response[0]);
                    for (i = 0; i < response.length; i++) {
                        $(".eqr").append("<p>" + response[i] + "</p>");
                        MathJax.typeset();
                    }


                }
            },
            error: function () {
                // response = jQuery.parseJSON(response);

                alert("لطفا دوباره تلاش نمایید");
            }
        });



    } else {
        alert("لطفا هیچ فیلدی را خالی نگذراید");
    }

});

$(document).ajaxStart(function () {
    $("#loadingGif").show();
});
$(document).ajaxStop(function () {
    $("#loadingGif").hide();
});

$(".calculator-row").click(function () {
    MathJax.typeset();
});
