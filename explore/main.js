$(document).ready(function () {
    $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > button.btn.btn-secondary.bg-bordo.rpa").click(function() {
        $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > button.btn.btn-secondary.bg-bordo.rqa").css({"opacity": "0.7"});
        $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > button.btn.btn-secondary.bg-bordo.rpa").css({"opacity": "1"});

        indicadorIndicador();
    });
    $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > button.btn.btn-secondary.bg-bordo.rqa").click(function() {
        $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > button.btn.btn-secondary.bg-bordo.rqa").css({"opacity": "1"})
        $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > button.btn.btn-secondary.bg-bordo.rpa").css({"opacity": "0.7"})
        
        QuatroAmazoniasIndicador();
    });
    function indicadorIndicador() {
        $("body > div.app-container.app-theme-white.body-tabs-shadow.fixed-header.fixed-sidebar.closed-sidebar > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div:nth-child(2)").show();
        // $("body > div.app-container.app-theme-white.body-tabs-shadow.fixed-header.fixed-sidebar.closed-sidebar > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div:nth-child(2) > div > div").show();
        $(".ano-ico").show();
        $(".ano").show();
        $(".territorio").hide();
        $(".territorio-ico").hide();
        $(".area-ico").hide();
        $(".area").hide();
        $(".indicador-ico").hide();
        $(".indicador").hide();
        $(".area1-ico").show();
        $(".area1").show();
        $(".indicador1-ico").show();
        $(".indicador1").show();
        $(".area2-ico").show();
        $(".area2").show();
        $(".indicador2-ico").show();
        $(".indicador2").show();

        $(".rpaHR").show();
        $(".rqaHR").hide();
        $("#btn-rpa").show()
        $("#btn-rqa").hide()
        setTimeout(() => {
            $("body > div.app-container.app-theme-white.body-tabs-shadow.fixed-header.fixed-sidebar.closed-sidebar > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div:nth-child(2)").css({"width": "30%"});
            $("body > div.app-container.app-theme-white.body-tabs-shadow.fixed-header.fixed-sidebar.closed-sidebar > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div:nth-child(4)").css({"width": "70%"});
            $("body > div.app-container.app-theme-white.body-tabs-shadow.fixed-header.fixed-sidebar.closed-sidebar > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div:nth-child(4) > div > div").css({"width": "100%"});
            $("body > div.app-container.app-theme-white.body-tabs-shadow.fixed-header.fixed-sidebar.closed-sidebar > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div:nth-child(2) > div > div").css({"width": "100%"});
        }, 400);

    }
    function QuatroAmazoniasIndicador() {
        $("body > div.app-container.app-theme-white.body-tabs-shadow.fixed-header.fixed-sidebar.closed-sidebar > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div:nth-child(2)").hide();
        // $("body > div.app-container.app-theme-white.body-tabs-shadow.fixed-header.fixed-sidebar.closed-sidebar > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div:nth-child(2) > div > div").hide();
        $(".ano").hide();
        $(".ano-ico").hide();
        $(".territorio").show();
        $(".territorio-ico").show();
        $(".area-ico").show();
        $(".area").show();
        $(".indicador-ico").show();
        $(".indicador").show();
        $(".area1-ico").hide();
        $(".area1").hide();
        $(".indicador1-ico").hide();
        $(".indicador1").hide();
        $(".area2-ico").hide();
        $(".area2").hide();
        $(".indicador2-ico").hide();
        $(".indicador2").hide();
        $(".rpaHR").hide();
        $(".rqaHR").show();
        $("#btn-rpa").hide()
        $("#btn-rqa").show()
        setTimeout(() => {
            $("body > div.app-container.app-theme-white.body-tabs-shadow.fixed-header.fixed-sidebar.closed-sidebar > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div:nth-child(4)").css({"width": "100%"});
            $("body > div.app-container.app-theme-white.body-tabs-shadow.fixed-header.fixed-sidebar.closed-sidebar > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div:nth-child(4) > div > div").css({"width": "100%"});
        }, 400);
    }
    indicadorIndicador()

    $( window ).resize(function() {
        // var tamanhoSelect = $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > select.regiao.form-control").width()
        // console.log(tamanhoSelect);
        // $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div").width(tamanhoSelect);
        setTimeout(() => {
            $("body > div.app-container.app-theme-white.body-tabs-shadow.fixed-header.fixed-sidebar").addClass("closed-sidebar");   
        }, 300);
    });

    //Consertando problemas no select de Proporção
    $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > button").addClass("form-control");
    $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > div > ul > li.ms-select-all > label > span").text("Selecionar Todos");
    $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > div > ul > li.multiple.selected").css("display", "none");


    // $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > select").change(function () {
    //     if (document.querySelector("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > button > span").textContent == "All selected") {
    //         $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > button > span").text("Todos");
    //     }
    //     if (document.querySelector("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > button > span").textContent.includes("Ano,")) {
    //         tempNome = document.querySelector("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > button > span").textContent
    //         tempNome = tempNome.split("Ano,");
    //         $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > button > span").text(tempNome[1])
    //     }
    // });

    setTimeout(() => {
        $("body > div.app-container.app-theme-white.body-tabs-shadow.fixed-header.fixed-sidebar").addClass("closed-sidebar");   
    }, 300);
});