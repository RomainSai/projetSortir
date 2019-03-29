$( document ).ready(

    function(){
        $("#myInputSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    }
);


function myFunction(check, Nomclass, sortie0) {

    var text = document.getElementsByClassName(Nomclass);
    var text1 = document.getElementsByClassName(sortie0);

    $('.saintErblain').hide();
    $('.chartresBretagne').hide();
    $('.rocheSurYon').hide();
    $('.quimper').hide();

    if (check.checked == true & text != null) {

        for (var i=0;i<text.length;i+=1){
            text[i].style.display = 'block';
            text1[i].style.display = 'none';
        }
    } else if (text != null) {
        for (var j=0;j<text.length;j+=1){
            text[j].style.display = 'none';
            text1[j].style.display = 'block';
        }
    }
}

triParSite = () => {
    var selectionne = $('#LeSelect option:selected').val();
    $('.saintErblain').hide();
    $('.chartresBretagne').hide();
    $('.rocheSurYon').hide();
    $('.quimper').hide();
    $('.sortie0').hide();
    $('.sorties1').hide();
    $('.sorties2').hide();
    $('.sorties3').hide();
    $('.sorties4').hide();


    switch (selectionne) {

        case("Saint-herblain"):
            $('.saintErblain').show();
            break;

        case("Chartres de Bretagne"):

            $('.chartresBretagne').show();
            break;

        case("La Roche Sur Yon"):

            $('.rocheSurYon').show();
            break;

        case("Quimper"):
            $('.quimper').show();
            break;
    }

}


// $(document).ready(function () {
//
//     })
//
/*function mySecondFunction() {

    var inputSite = document.getElementById('LeSelect');
    var text1 = document.getElementsByClassName('bloc1Checkbox');
    var noSite = inputSite.selectedIndex;
    var blocSaintErblain = document.getElementsByClassName('saintErblain');
    var blocChartresBretagne = document.getElementsByClassName('chartresBretagne');
    var blocRocheSurYon = document.getElementsByClassName('rocheSurYon');
    var quimper = document.getElementsByClassName('quimper');

    for (var i=0;i<blocSaintErblain.length;i+=1){
        blocSaintErblain[i].style.diplay = 'none';
        console.log('je suis rentré dans la boucle saint erblain');
        text1[i].style.display = 'none';
    }
    for (var i=0;i<blocChartresBretagne.length;i+=1){
        blocChartresBretagne[i].style.diplay = 'none';
        console.log('je suis rentré dans la boucle chartres de bretagne');
        text1[i].style.display = 'none';
    }
    for (var i=0;i<blocRocheSurYon.length;i+=1){
        blocRocheSurYon[i].style.diplay = 'none';
        console.log('je suis rentré dans la boucle roche sur yon');
        text1[i].style.display = 'none';
    }
    for (var i=0;i<quimper.length;i+=1){
        quimper[i].style.diplay = 'none';
        console.log('je suis rentré dans la boucle quimper');
        text1[i].style.display = 'none';
    }

    switch (noSite) {

        case (1):
            for (var i=0;i<blocSaintErblain.length;i+=1) {
                text1[i].style.display = 'none';
                blocSaintErblain[i].style.display = 'block';

                }
            break;
        case (2):
            for (var i=0;i<blocChartresBretagne.length;i+=1) {
                blocChartresBretagne[i].style.display = 'block';
                text1[i].style.display = 'none';}
            break;
        case (3):
            for (var i=0;i<blocRocheSurYon.length;i+=1) {
                blocRocheSurYon[i].style.display = 'block';
                text1[i].style.display = 'none';}
            break;
        case (4):
            for (var i=0;i<quimper.length;i+=1) {
                quimper[i].style.display = 'block';
                text1[i].style.display = 'none';}
            break;
        default:

            break;
    }
}*/