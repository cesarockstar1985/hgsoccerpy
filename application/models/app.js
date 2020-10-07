$.getJSON('/assets/data/menu.json', function (json) {
    app.menu = json;
});

var routes = [
    { path: '/', component: httpVueLoader('/assets/pages/news.vue') },

    { path: '/quienes-somos', component: httpVueLoader('/assets/pages/company_abouts.vue') },
    { path: '/autoridades', component: httpVueLoader('/assets/pages/company_authority.vue') },
    { path: '/organigrama', component: httpVueLoader('/assets/pages/company_organization_chart.vue') },
    { path: '/publicaciones', component: httpVueLoader('/assets/pages/company_publication.vue') },
    { path: '/concursos', component: httpVueLoader('/assets/pages/company_competition.vue') },
    { path: '/convenios', component: httpVueLoader('/assets/pages/company_agreement.vue') },
    { path: '/pasantias', component: httpVueLoader('/assets/pages/company_jobs.vue') },

    { path: '/presencia-institucional', component: httpVueLoader('/assets/pages/map_presence_institutional.vue') },
    { path: '/muestras-de-HLB', component: httpVueLoader('/assets/pages/map_hlb.vue') },
    { path: '/registros-de-agroquimicos', component: httpVueLoader('/assets/pages/map_agrochemical_records.vue') },
    { path: '/registros-de-agricultura-organica', component: httpVueLoader('/assets/pages/map_agrochemical_organic_records.vue') },
    { path: '/mapa-registro-de-semillas', component: httpVueLoader('/assets/pages/map_seed_register.vue') },
    { path: '/mapa-laboratorio-semillas', component: httpVueLoader('/assets/pages/map_seed_laboratory.vue') },
    { path: '/mapa-proteccion-vegetal', component: httpVueLoader('/assets/pages/map_plant_protection.vue') },

    { path: '/noticias', component: httpVueLoader('/assets/pages/news.vue') },
    { path: '/noticias/:page', component: httpVueLoader('/assets/pages/news_view.vue') },

    { path: '/leyes', component: httpVueLoader('/assets/pages/mj_laws.vue') },
    { path: '/informes-auditoria', component: httpVueLoader('/assets/pages/auditoria.vue') },
    { path: '/decretos', component: httpVueLoader('/assets/pages/mj_decrees.vue') },
    { path: '/resoluciones-del-senave', component: httpVueLoader('/assets/pages/mj_resolutions_senave.vue') },
    { path: '/resoluciones-anteriores', component: httpVueLoader('/assets/pages/resolutions_previous.vue') },
    { path: '/resoluciones-del-mercosur', component: httpVueLoader('/assets/pages/mj_resolutions_mercosur.vue') },
    { path: '/resoluciones-mag', component: httpVueLoader('/assets/pages/mj_resolutions_mag.vue') },

    { path: '/sgc-direcciones/:direccion', component: httpVueLoader("/assets/pages/sgc-direcciones.vue")},
    { path: '/sgc-departamentos/:departamento/:exists?', component: httpVueLoader("/assets/pages/sgc-departamentos.vue")},
    { path: '/sgc-interno/', component: httpVueLoader("/assets/pages/sgc-interno.vue")},
    { path: '/proteccion-y-uso-de-variedades', component: httpVueLoader('/assets/pages/protection_and_use_of_varieties.vue') },
    { path: '/certificacion', component: httpVueLoader('/assets/pages/certification.vue') },
    { path: '/comercio', component: httpVueLoader('/assets/pages/commerce.vue') },
    { path: '/boletines', component: httpVueLoader('/assets/pages/newsletters.vue') },
    { path: '/satisfaccion-y-reclamos', component: httpVueLoader('/assets/pages/satisfaction_and_claims.vue') },
    { path: '/lista-ensayos', component: httpVueLoader('/assets/pages/list_essays.vue') },
    { path: '/descriptores-varietales', component: httpVueLoader('/assets/pages/varietal-descriptors.vue') },
    { path: '/registros', component: httpVueLoader('/assets/pages/records.vue') },
    { path: '/registrosnuevos', component: httpVueLoader('/assets/pages/recordsnew.vue') },
    { path: '/solicitud-de-registro-con-categoria-definitivo', component: httpVueLoader('/assets/pages/registration-application-with-definitive-category.vue') },
    { path: '/propiedades-fisicas-quimicas', component: httpVueLoader('/assets/pages/chemical-physical-properties-tables.vue') },
    { path: '/importacion', component: httpVueLoader('/assets/pages/import.vue') },
    { path: '/exportacion', component: httpVueLoader('/assets/pages/export.vue') },
    { path: '/muestra', component: httpVueLoader('/assets/pages/sample.vue') },
    { path: '/transporte-agroquimicos', component: httpVueLoader('/assets/pages/transport_agrochemicals.vue') },
    { path: '/depositos-de-agroquimicos', component: httpVueLoader('/assets/pages/deposit-enabling-form.vue') },
    { path: '/extension-de-fecha-validez', component: httpVueLoader('/assets/pages/date-extension.vue') },
    { path: '/circulares', component: httpVueLoader('/assets/pages/circular.vue') },
    { path: '/dicao', component: httpVueLoader('/assets/pages/dicao.vue') },
    { path: '/inocuidad', component: httpVueLoader('/assets/pages/harmlessness.vue') },
    { path: '/organica', component: httpVueLoader('/assets/pages/organic.vue') },
    { path: '/dicao-departamento-de-trazabilidad-vegetal', component: httpVueLoader('/assets/pages/dicao_department_vegetal.vue') },
    { path: '/cuarentena-vegetal', component: httpVueLoader('/assets/pages/quarantine_vegetable.vue') },
    { path: '/departamento-de-muestreo-laboratorial-especializado', component: httpVueLoader('/assets/pages/department_of_sampling_laboratorial_specialized.vue') },
    { path: '/laboratorio-de-control-de-calidad-de-insumos-de-uso-agricola', component: httpVueLoader('/assets/pages/laboratory_of_control_of_quality_of_inputs_of_use_agricultural.vue') },
    { path: '/laboratorio-de-residuo-de-plaguicidas-y-micotoxinas', component: httpVueLoader('/assets/pages/waste_laboratory_pesticides_and_mycotoxins.vue') },
    { path: '/laboratorio-quejas-y-sugerencia', component: httpVueLoader('/assets/pages/laboratory_complaints_and_suggestion.vue') },
    { path: '/laboratorio-semillas', component: httpVueLoader('/assets/pages/seed_laboratory.vue') },
    { path: '/laboratorio-biologia-molecular', component: httpVueLoader('/assets/pages/laboratory_molecular_biology.vue') },
    { path: '/operaciones-registros', component: httpVueLoader('/assets/pages/operations_records.vue') },
    { path: '/operaciones-resoluciones', component: httpVueLoader('/assets/pages/operations_resolutions.vue') },
    { path: '/fiscalizacion-de-ensayos-regulados', component: httpVueLoader('/assets/pages/auditing_of_tests_regulated.vue') },
    { path: '/informe-de-interes-tecnico', component: httpVueLoader('/assets/pages/technical_report_of_interest.vue') },
    { path: '/importacion-y-exportacion', component: httpVueLoader('/assets/pages/import_export.vue') },
    { path: '/servicios-satisfaccion-y-reclamos', component: httpVueLoader('/assets/pages/services_complaints_and_suggestion.vue') },

    { path: '/bioseguridad', component: httpVueLoader('/assets/pages/bioseguridad.vue') },

    { path: '/enlaces', component: httpVueLoader('/assets/pages/links.vue') },
    { path: '/contactenos', component: httpVueLoader('/assets/pages/contact.vue') },
    { path: '/fitosanitarios/certificado', component: httpVueLoader('/assets/pages/fitosanitarios_certificado.vue') },
    { path: '/numero-de-contacto', component: httpVueLoader('/assets/pages/whatsapp.vue') },

    { path: '/hlb', component: httpVueLoader('/assets/pages/hlb.vue') },
    { path: '/alertas-fitosanitarias', component: httpVueLoader('/assets/pages/fitosanitarios_alert.vue') },
    { path: '/cultivo-banano', component: httpVueLoader('/assets/pages/cultivo-banano.vue') },
    { path: '/prevencion-plaga-picudo', component: httpVueLoader('/assets/pages/prevencion-de-la-plaga-picudo.vue') },
    { path: '/enfermedad-huanglongbing', component: httpVueLoader('/assets/pages/enfermedad-huanglongbing.vue') },
    { path: '/cultivos-extensivos-de-soja', component: httpVueLoader('/assets/pages/cultivos-extensivos-de-soja.vue') },
    { path: '/alerta-y-vigilancia-fitosanitaria-de-Lobesia-botrana', component: httpVueLoader('/assets/pages/alerta-y-vigilancia-fitosanitaria-de-Lobesia-botrana.vue') },
    { path: '/drosophila-suzukii-bactrocera', component: httpVueLoader('/assets/pages/drosophila-suzukii-bactrocera.vue') },
    { path: '/vigilancia-fitosanitaria-de-mosca-de-la-fruta', component: httpVueLoader('/assets/pages/vigilancia-fitosanitaria-de-mosca-de-la-fruta.vue') },
    { path: '/cultivo-de-sesamo-sesamun-indicum', component: httpVueLoader('/assets/pages/cultivo-de-sesamo-sesamun-indicum.vue') },
    { path: '/monitoreo-y-control-de-langosta-voladora', component: httpVueLoader('/assets/pages/monitoreo-y-control-de-langosta-voladora.vue') },
    { path: '/plantaciones-forestales-con-enfasis-a-eucaliptus', component: httpVueLoader('/assets/pages/plantaciones-forestales-con-enfasis-a-eucaliptus.vue') },
    { path: '/proteccion-vegetal', component: httpVueLoader('/assets/pages/plant_protection.vue') },
    { path: '/proyectos-de-normativas-en-consulta', component: httpVueLoader('/assets/pages/normative_projects.vue') },
    { path: '/registro-unico', component: httpVueLoader('/assets/pages/record_only.vue') },
    { path: '/registro-unico-consulta', component: httpVueLoader('/assets/pages/ruc.vue') },
    { path: '/registro-unico-sugerencias', component: httpVueLoader('/assets/pages/rus.vue') },
    { path: '/boletin-estadistico', component: httpVueLoader('/assets/pages/newsletter_statistic.vue') },

    { path: '/audiovisual', component: httpVueLoader('/assets/pages/audiovisual.vue') },
    { path: '/fitosanitarios/importacion', component: httpVueLoader('/assets/pages/fitosanitarios_import.vue') },
    { path: '/fitosanitarios/exportacion', component: httpVueLoader('/assets/pages/fitosanitarios_export.vue') },
    { path: '/plaguicidas-ilegales', component: httpVueLoader('/assets/pages/pesticides_illegals.vue') },
    { path: '/informacion-publica', component: httpVueLoader('/assets/pages/public_information.vue') },
    { path: '/app/download', component: httpVueLoader('/assets/pages/app_download.vue') },
    { path: '/app/politicas-de-privacidad', component: httpVueLoader('/assets/pages/app_politica.vue') },

    { path: '/accesos-directos', component: httpVueLoader('/assets/pages/shortcuts.vue') },
    { path: '/codigo-documentos-internos-operaciones', component: httpVueLoader('/assets/pages/internal_document.vue') },

    { path: '/programas-institucionales-en-ejecucion', component: httpVueLoader('/assets/pages/programs_institutional_in_execution.vue') },
    { path: '/cartas-oficiales', component: httpVueLoader('/assets/pages/official_letters.vue') },
    { path: '/informes-finales-de-consultorias', component: httpVueLoader('/assets/pages/final_reports_of_consulting.vue') },
    { path: '/procedimientos-previstos', component: httpVueLoader('/assets/pages/procedures_planned.vue') },

    { path: "*", component: httpVueLoader('/assets/pages/errors/404.vue') }
];

var router = new VueRouter({
    routes,
    mode: 'history',
    base: '/'
});

var app = new Vue({
    el: '#app',
    components: {
        'vheader': httpVueLoader('/assets/components/Header.vue'),
        'vsidebar': httpVueLoader('/assets/components/Sidebar.vue'),
        'vfooter': httpVueLoader('/assets/components/Footer.vue'),
        'About': httpVueLoader('/assets/pages/about.vue'),
    },
    data: {
        docs1: [],
        docs2: [],
        docs3: [],
        docs4: [],
        doc_show: false,
        maintenance: false,
        maintenanceText: "En estos momentos, estamos realizando algunas mejoras en la web, por lo cual se pueden producir cortes en el acceso a la misma.",
        menu: null,
        news: null,
        news_home: null,
        news_count: 0,
        newsList: null,
        paginate: ['news'],
        resolutions: null,
        vtemp: '1',
        products_i: null,
        products_ir: null,
        products_irv: null,
        products_e: null,
        products_er: null,
        products_erv: null,
        products_country: null,
        products_part: null,
        products_use: [
            { 'code': '0', 'name': 'Todos' },
            { 'code': '1', 'name': 'Consumo' },
            { 'code': '2', 'name': 'Propagacion' },
            { 'code': '3', 'name': 'Transformacion' }
        ],
        newsval:        [],
        sgcVal:         [],
        departamentos:     [],
        direccionesInterno: []
    },
    methods: {
        checkFitosanitariosI: function (e) {
            e.preventDefault();
            app.products_ir = null;
            var formData = new FormData();
            formData.append('product', $('#producti').val());
            formData.append('country', $('#country').val());
            formData.append('use', $('#use').val());
            formData.append('part', $('#part').val());
            this.$http.post('/assets/queries/fimport.php', formData).then(function (response) {
                app.products_ir = response.data;
            });
        },
        checkFitosanitariosE: function (e) {
            e.preventDefault();
            app.products_er = null;
            var formData = new FormData();
            formData.append('product', $('#producte').val());
            formData.append('country', $('#country').val());
            formData.append('use', $('#use').val());
            formData.append('part', $('#part').val());
            this.$http.post('/assets/queries/fexport.php', formData).then(function (response) {
                app.products_er = response.data;
            });
        },
        docint: function (e) {
            e.preventDefault();
            if ($("#password").val() == '852456') {
                app.doc_show = 1;
            } else {
                $('#result').html('<div class="alert alert-danger">El código ingresado no es valido...!!!</div>').fadeOut(1).delay(800).fadeIn(400);
            }
        },
        frucs: function (e) {
            e.preventDefault();
            $("#submitBtn").attr("disabled", true);
            $("#submitBtn").html('Enviando...');
            if ($('#name').val() && $('#phone').val() && $('#email').val() && $('#message').val()) {
                var formData = new FormData();
                formData.append('name', $('#name').val());
                formData.append('phone', $('#phone').val());
                formData.append('email', $('#email').val());
                formData.append('message', $('#message').val());
                this.$http.post('/assets/queries/contact.php', formData).then(
                    $('#result').html('<div class="alert alert-success">El mensaje ha sido enviado...!!!</div>').fadeOut(1).delay(800).fadeIn(400)
                );
            } else {
                $('#result').html('<div class="alert alert-danger">Complete todo los campos para mandar el mensaje...!!!</div>').fadeOut(1).delay(800).fadeIn(400);
            }
            $("#submitBtn").html('Enviar');
            $("#submitBtn").removeAttr("disabled");
        },
        newsMore: function (e) {
            if (app.news_home === null) {
                $.getJSON('/assets/queries/news.php?limit=4', function (json) {
                    app.news_home = json;
                    window.setTimeout(function () {
                        $('.owl-carousel').owlCarousel({
                            autoplay: true,
                            autoplayTimeout: 5000,
                            autoplayHoverPause: false,
                            loop: true,
                            nav: false,
                            // dots: false,
                            items: 1,
                        });
                    }, 1000);
                });
            }
            $("#newsmore").attr("disabled", true);
            $("#newsmore").html('<i class="fas fa-spinner fa-spin mr-2"></i>Cargando más noticias...');
            app.news_count++;
            $.getJSON('/assets/queries/news.php?limit=4,' + (app.news_count * 8), function (json) {
                app.news = json;
                $('#newsmore').html('<i class="fas fa-plus mr-2"></i>ver más noticias');
                $("#newsmore").removeAttr("disabled");
            });
        },
        newsearch: function (e) {
            e.preventDefault();
            $("#searchBtn").attr("disabled", true);
            $("#searchBtn").html('Buscando...');
            if ($('#search').val() != '') {
                $("#newsmore").hide();
                ts = $('#search').val();
                $.getJSON('/assets/queries/news.php?search=' + ts, function (json) {
                    app.news = json;
                });
            } else {
                app.news_count = 0;
                $("#newsmore").show();
                app.newsMore();
            }
            $("#searchBtn").html('Buscar');
            $("#searchBtn").removeAttr("disabled");
        },
        newsview: function (e) {
            $.getJSON('/assets/queries/news_view.php?id=' + e, function (json) {
                app.newsval = json;
            });
        },
        sgcview: function (e) {
            $.getJSON('/assets/queries/sgc.php?id=' + e, function (json) {
                app.sgcVal = json;
            });
        },
        sgcviewDepartamentos: function (e) {
            $.getJSON('/assets/queries/sgc-departamentos.php?id=' + e, function (json) {
                
                if (json.message) {
                    console.log("no hay departamentos");
                    //router.go(`/sgc-departamentos/${json.idDireccion}/false`);
                }else{
                    app.departamentos = json;
                }

            });
        },
        sgcviewInterno: function () {
            $.getJSON('/assets/queries/sgc-interno.php?id=excluded', function (json) {
                
                if (json.message) {
                    console.log("no hay direcciones");
                }else{

                    //console.log(json.direccion);
                    app.direccionesInterno = json;
                }

            });
        },
        vcomuni: function (e) {
            return removeArray(app.products_i.filter(x => x.code === e).map(x => x.comun));
        },
        vcientificoi: function (e) {
            return removeArray(app.products_i.filter(x => x.code === e).map(x => x.cientifico));
        },
        vcomune: function (e) {
            return removeArray(app.products_e.filter(x => x.code === e).map(x => x.comun));
        },
        vcientificoe: function (e) {
            return removeArray(app.products_e.filter(x => x.code === e).map(x => x.cientifico));
        },
        vcountry: function (e) {
            return removeArray(app.products_country.filter(x => x.code === e).map(x => x.name));
        },
        vuse: function (e) {
            return removeArray(app.products_use.filter(x => x.code === e).map(x => x.name));
        },
        vpart: function (e) {
            return removeArray(app.products_part.filter(x => x.code === e).map(x => x.name));
        },
    },
    router,
});

$.getJSON('/assets/data/menu.json', function (json) {
    app.menu = json;
});

window.onload = function () {
    $(".loader").fadeOut("slow");
};

function removeArray(e) {
    return e.toString().replace(/['"]+/g, '');
}
$(document).ready(function () {
    $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
        var $el = $(this);
        var $parent = $(this).offsetParent(".dropdown-menu");
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');

        $(this).parent("li").toggleClass('show');

        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
            $('.dropdown-menu .show').removeClass("show");
        });

        if (!$parent.parent().hasClass('navbar-nav')) {
            $el.next().css({ "top": $el[0].offsetTop, "left": $parent.outerWidth() - 4 });
        }

        return false;
    });


    setTimeout(function () {
        $('#modalDenuncia').modal();
    }, 2000);

});