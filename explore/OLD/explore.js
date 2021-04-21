$(document).ready(function () {
    $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > button.btn.btn-secondary.bg-bordo.rpa").click(function() {
        $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > button.btn.btn-secondary.bg-bordo.rqa").css({"opacity": "0.7"});
        $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > button.btn.btn-secondary.bg-bordo.rpa").css({"opacity": "1"});

        PoliticoAdministrativo();
    });
    $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > button.btn.btn-secondary.bg-bordo.rqa").click(function() {
        $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > button.btn.btn-secondary.bg-bordo.rqa").css({"opacity": "1"})
        $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > button.btn.btn-secondary.bg-bordo.rpa").css({"opacity": "0.7"})
        
        QuatroAmazonias();
    });
    function PoliticoAdministrativo() {
        $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div").hide();
        $(".territorio").hide();
        $(".pct").hide();
        $(".territorio-ico").hide();
        $(".ajust-ico").hide();
        $(".rpaHR").show();
        $(".rqaHR").hide();
        $("#btn-rpa").show()
        $("#btn-rqa").hide()

    }
    function QuatroAmazonias() {
        $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div").show();
        $(".territorio").show();
        $(".pct").show();
        $(".territorio-ico").show();
        $(".ajust-ico").show();
        $(".rpaHR").hide();
        $(".rqaHR").show();

        setTimeout(() => {
            tamanhoProporcao = $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div").width();
            console.log("tamanhoProporcao", tamanhoProporcao);
            $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div").css({"width": tamanhoProporcao});
        }, 150);

        var tamanhoSelect = $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > select.regiao.form-control").width()
        $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div").width(tamanhoSelect);
        $("#btn-rpa").hide()
        $("#btn-rqa").show()
    }
    PoliticoAdministrativo()
    setTimeout(() => {
        $("body > div.app-container.app-theme-white.body-tabs-shadow.fixed-header.fixed-sidebar").addClass("closed-sidebar");   
    }, 1000);
});