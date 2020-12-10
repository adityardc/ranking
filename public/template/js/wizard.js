(function($) {
    'use strict';
    var form = $("#frmProfil");
    form.validate({
        rules: {
            risiko_id: {
                required: true
            },
            tanggal_posting: {
                required: true
            },
            sasaran: {
                required: true,
                maxlength: 150
            },
            risk_owner: {
                required: true,
                maxlength: 150
            },
            nip: {
                required: true,
                maxlength: 150
            },
            risk_officer: {
                required: true,
                maxlength: 150
            },
            kamr: {
                required: true,
                maxlength: 150
            },
            indikator: {
                required: true
            },
            penyebab: {
                required: true
            },
            dampak: {
                required: true
            },
            pengendalian: {
                required: true
            },
            efektivitas: {
                required: true,
                maxlength: 150
            },
        },
        messages: {
            risiko_id: {
                required: "Kolom harus diisi !"
            },
            tanggal_posting: {
                required: "Kolom harus diisi !"
            },
            sasaran: {
                required: "Kolom harus diisi !"
            },
            risk_owner: {
                required: "Kolom harus diisi !"
            },
            nip: {
                required: "Kolom harus diisi !"
            },
            risk_officer: {
                required: "Kolom harus diisi !"
            },
            kamr: {
                required: "Kolom harus diisi !"
            },
            indikator: {
                required: "Kolom harus diisi !"
            },
            penyebab: {
                required: "Kolom harus diisi !"
            },
            dampak: {
                required: "Kolom harus diisi !"
            },
        },
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        }
    });

    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function(event, currentIndex, newIndex){
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function(event, currentIndex){
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            alert("Submitted!");
        }
    });
})(jQuery);
