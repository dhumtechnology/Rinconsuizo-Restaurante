(function($) {
    var modoJuntar = false;
    var seleccionadas = [];

    if (!$('#estilos-mesas-union').length) {
        $('head').append(
            '<style id="estilos-mesas-union">' +
            '#salas-mesas.modo-juntar-activo .mesa-unible { cursor: crosshair; }' +
            '.mesa-unible.mesa-seleccionada .miMesa {' +
            '  box-shadow: 0 0 0 3px #fff, 0 0 14px 5px #5bc0de, 0 0 24px 8px rgba(91, 192, 222, 0.85);' +
            '  animation: mesa-seleccion-brillo 1.4s ease-in-out infinite;' +
            '}' +
            '@keyframes mesa-seleccion-brillo {' +
            '  0%, 100% { box-shadow: 0 0 0 3px #fff, 0 0 12px 4px #5bc0de, 0 0 20px 6px rgba(91, 192, 222, 0.65); }' +
            '  50% { box-shadow: 0 0 0 4px #fff, 0 0 20px 8px #31b0d5, 0 0 32px 12px rgba(49, 176, 213, 1); }' +
            '}' +
            '#btn-modo-juntar.active { box-shadow: 0 0 8px rgba(91, 192, 222, 0.8); }' +
            '</style>'
        );
    }

    function notificar(msg, tipo) {
        if (typeof $.noty !== 'undefined') {
            noty({
                text: msg,
                layout: 'topRight',
                type: tipo || 'information',
                timeout: 3500
            });
        } else {
            alert(msg);
        }
    }

    function marcarMesaSeleccionada(codmesa, activo) {
        var $mesa = $('#salas-mesas .mesa-unible[data-codmesa="' + codmesa + '"]');
        if (activo) {
            $mesa.addClass('mesa-seleccionada');
        } else {
            $mesa.removeClass('mesa-seleccionada');
        }
    }

    function actualizarContador() {
        var $contador = $('#juntar-mesas-contador');
        if (!$contador.length) {
            return;
        }
        if (seleccionadas.length > 0) {
            $contador.text(seleccionadas.length + ' seleccionada(s)').show();
        } else {
            $contador.hide();
        }
    }

    function limpiarSeleccion() {
        seleccionadas.forEach(function(codmesa) {
            marcarMesaSeleccionada(codmesa, false);
        });
        seleccionadas = [];
        actualizarContador();
    }

    function aplicarEstadoBarra() {
        if (!modoJuntar) {
            return;
        }
        $('#salas-mesas').addClass('modo-juntar-activo');
        $('#juntar-mesas-ayuda, #btn-confirmar-juntar, #btn-cancelar-juntar').show();
        $('#btn-modo-juntar').addClass('active');
        seleccionadas.forEach(function(codmesa) {
            marcarMesaSeleccionada(codmesa, true);
        });
        actualizarContador();
    }

    function salirModoJuntar() {
        modoJuntar = false;
        limpiarSeleccion();
        $('#salas-mesas').removeClass('modo-juntar-activo');
        $('#juntar-mesas-ayuda, #btn-confirmar-juntar, #btn-cancelar-juntar').hide();
        $('#btn-modo-juntar').removeClass('active');
    }

    function entrarModoJuntar() {
        modoJuntar = true;
        limpiarSeleccion();
        aplicarEstadoBarra();
    }

    window.mesasUnionModoActivo = function() {
        return modoJuntar;
    };

    window.restaurarModoJuntarMesas = function() {
        if (!modoJuntar) {
            return;
        }
        aplicarEstadoBarra();
    };

    window.manejarClickMesa = function(el, codmesaEnc) {
        if (!modoJuntar) {
            RecibeMesa(codmesaEnc);
            return;
        }

        var $el = $(el);
        var codmesa = parseInt($el.data('codmesa'), 10);
        var codsala = String($el.data('codsala'));
        var status = parseInt($el.data('statusmesa'), 10);
        var pedidoActivo = parseInt($el.data('pedido-activo'), 10) === 1;

        if (status !== 0 || pedidoActivo) {
            notificar('No puede juntar mesas con pedido en curso. Espere a que el cajero cierre la cuenta.', 'warning');
            return;
        }

        var idx = seleccionadas.indexOf(codmesa);
        if (idx >= 0) {
            seleccionadas.splice(idx, 1);
            marcarMesaSeleccionada(codmesa, false);
            actualizarContador();
            return;
        }

        if (seleccionadas.length > 0) {
            var primera = $('#salas-mesas .mesa-unible[data-codmesa="' + seleccionadas[0] + '"]');
            if (primera.length && String(primera.data('codsala')) !== codsala) {
                notificar('Las mesas deben estar en el mismo salón.', 'error');
                return;
            }
        }

        seleccionadas.push(codmesa);
        marcarMesaSeleccionada(codmesa, true);
        actualizarContador();
    };

    function confirmarUnion() {
        if (seleccionadas.length < 2) {
            notificar('Seleccione al menos dos mesas.', 'warning');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'funciones.php',
            data: { accion: 'JuntarMesas', mesas: seleccionadas },
            dataType: 'json',
            success: function(res) {
                if (res && res.ok) {
                    notificar(res.msg || 'Mesas unidas.', 'success');
                    salirModoJuntar();
                    if (typeof recargarMesasPanel === 'function') {
                        recargarMesasPanel(true);
                    }
                } else {
                    notificar((res && res.msg) ? res.msg : 'No se pudo unir las mesas.', 'error');
                }
            },
            error: function() {
                notificar('Error al unir las mesas.', 'error');
            }
        });
    }

    function separarMesas(codmesa) {
        if (!confirm('¿Separar las mesas unidas?')) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'funciones.php',
            data: { accion: 'SepararMesasUnion', codmesa: codmesa },
            dataType: 'json',
            success: function(res) {
                if (res && res.ok) {
                    notificar(res.msg || 'Mesas separadas.', 'success');
                    if (typeof recargarMesasPanel === 'function') {
                        recargarMesasPanel(true);
                    }
                    if (typeof mostrarVistaMesas === 'function') {
                        mostrarVistaMesas();
                    }
                    $('#recibemesa').empty();
                } else {
                    notificar((res && res.msg) ? res.msg : 'No se pudo separar.', 'error');
                }
            },
            error: function() {
                notificar('Error al separar las mesas.', 'error');
            }
        });
    }

    $(document).ready(function() {
        $(document).on('click', '#btn-modo-juntar', function(e) {
            e.preventDefault();
            if (modoJuntar) {
                salirModoJuntar();
            } else {
                entrarModoJuntar();
            }
        });

        $(document).on('click', '#btn-cancelar-juntar', function(e) {
            e.preventDefault();
            salirModoJuntar();
        });

        $(document).on('click', '#btn-confirmar-juntar', function(e) {
            e.preventDefault();
            confirmarUnion();
        });

        $(document).on('click', '#btn-separar-mesas', function(e) {
            e.preventDefault();
            var codmesa = $(this).data('codmesa');
            if (codmesa) {
                separarMesas(codmesa);
            }
        });
    });
})(jQuery);
