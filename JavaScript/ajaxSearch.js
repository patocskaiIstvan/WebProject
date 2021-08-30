$("#search").keyup(function(e) {
    let src = $("#search").val();
    $.ajax({
        type: "POST",
        url: "../php/petsAjaxSearch.php",
        data: {
            search: $("#search").val()
        },
        success: function(result) {
            $(".advertisement-main-div").html(result);
        }
    });

//minden gomb lenyomásra elküldi az input fieldbe beírt adatot a petsAjaxSearch.php oldalra, ott pedig rákeres az adatbázisban a bevitte elemre.
    

});