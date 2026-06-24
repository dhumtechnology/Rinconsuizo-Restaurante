(function($) {
    function pad(n) {
        return n < 10 ? '0' + n : '' + n;
    }

    function formatEspera(totalSec) {
        if (totalSec < 0) {
            totalSec = 0;
        }
        var h = Math.floor(totalSec / 3600);
        totalSec %= 3600;
        var m = Math.floor(totalSec / 60);
        var s = totalSec % 60;
        if (h > 0) {
            return pad(h) + ':' + pad(m) + ':' + pad(s);
        }
        return pad(m) + ':' + pad(s);
    }

    window.actualizarTimersMesas = function() {
        var ahora = Math.floor(Date.now() / 1000);

        $('.mesa-espera').each(function() {
            var $badge = $(this);
            var inicioTs = parseInt($badge.data('inicio-ts'), 10);

            if (isNaN(inicioTs) || inicioTs <= 0) {
                return;
            }

            var diffSec = ahora - inicioTs;
            $badge.find('.mesa-espera-text').text(formatEspera(diffSec));

            var minutos = diffSec / 60;
            if (minutos >= 15) {
                $badge.css('background', '#d9534f');
            } else if (minutos >= 5) {
                $badge.css('background', '#f0ad4e');
            } else {
                $badge.css('background', '#333');
            }
        });
    };

    window.recargarMesasPanel = function() {
        if (!$('#salas-mesas').length) {
            return;
        }
        $.get('funciones.php?MesasPanel=si', function(html) {
            $('#salas-mesas').html(html);
            actualizarTimersMesas();
        });
    };

    window.recargarMesasPanelCocinero = function(callback) {
        if (!$('#salas-mesas-cocinero').length) {
            if (callback) {
                callback();
            }
            return;
        }
        var $panel = $('#salas-mesas-cocinero');
        var tabActiva = window.cocineroTabActiva || '';
        if (!tabActiva) {
            var $activeLink = $panel.find('#cocinero-tabs li.active a');
            if ($activeLink.length) {
                tabActiva = $activeLink.attr('href');
            }
        }
        $.get('funciones.php?MesasPanelCocinero=si', function(html) {
            $panel.html(html);
            if (tabActiva && $panel.find('#cocinero-tabs a[href="' + tabActiva + '"]').length) {
                $panel.find('#cocinero-tabs a[href="' + tabActiva + '"]').tab('show');
            }
            actualizarTimersMesas();
            if (callback) {
                callback();
            }
        });
    };

    window.cocineroTabActiva = '';

    $(document).on('shown.bs.tab', '#salas-mesas-cocinero #cocinero-tabs a[data-toggle="tab"]', function(e) {
        window.cocineroTabActiva = $(e.target).attr('href');
    });

    $(function() {
        actualizarTimersMesas();
        setInterval(actualizarTimersMesas, 1000);
    });
})(jQuery);
