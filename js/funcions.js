$(document).ready(function() {
    // Función para ocultar categorías y cargar productos al hacer clic en .prod
    $(document).on('click', '.prod', function() {
        var $categorias = $('.categoria');
        $categorias.hide();

        var categoriaNombre = $(this).find('#categoria_nom h3').text();
        $('#categoriaSeleccionada').text('Categoria seleccionada: ' + categoriaNombre);

        var categoria_id = $(this).find('a').attr('id');

        $('#paginaProductos').hide().load('../index.php?accio=productes&categoria_id=' + categoria_id, function() {
            console.log("Load completed!");
        }).fadeIn(0);
    });

    // Función para ocultar productos y cargar detalles al hacer clic en .prod2
    $(document).on('click', '.prod2', function() {
        var $productes = $('.product-list');
        $productes.hide();

        var productes_id = $(this).find('a').attr('id');

        $('#paginaProductosDetall').hide().load('../index.php?accio=detallproducte&productes_id=' + productes_id, function() {
            console.log("Load completed!!!!!");
        }).fadeIn(0);
    });

// Nueva función para mostrar el resumen del carrito
    function showCartSummary() {
        // Realizar una solicitud AJAX para obtener el resumen del carrito
        $.ajax({
            type: 'GET',
            url: '../index.php?accio=resumenCarrito',
            success: function(response) {
                // Verificar si hay algo en el carrito antes de mostrar el resumen
                var totalProducts = parseInt(response.split(':')[1].trim());
                if (totalProducts > 0) {
                    // Actualizar el contenido de nav3 con el resumen obtenido
                    $('.nav3 #cartSummary').html(response);

                    // Habilitar o deshabilitar el botón de "Finalizar Compra"
                    $('#finishPurchaseBtn').prop('disabled', totalProducts === 0);

                    $('.nav3').show();
                } else {
                    // Si no hay productos en el carrito, ocultar el resumen
                    $('.nav3').hide();
                }
                console.log("resumenc");
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    $(document).ready(function() {
        showCartSummary();
    });


    $(document).on('click', '#addToCartBtn', function() {
        var productId = $('#productId').val();
        var quantity = $('#quantity').val();

        // Verificar si el botón está deshabilitado
        if ($(this).prop('disabled')) {
            return;
        }

        // Deshabilitar el botón para evitar clics adicionales
        $(this).prop('disabled', true);

        // Realizar una solicitud AJAX para agregar el producto al carrito
        $.ajax({
            type: 'POST',
            url: '../index.php?accio=anadirCarrito',
            data: { productId: productId, quantity: quantity },
            success: function(response) {
                alert(response); // Mostrar mensaje de éxito o error

                // Actualizar el icono del carrito en el header
                showCartSummary();

                // Volver a habilitar el botón después de la actualización del carrito
                $('#addToCartBtn').prop('disabled', false);
            },
            error: function(error) {
                console.log(error);
                // Volver a habilitar el botón en caso de error
                $('#addToCartBtn').prop('disabled', false);
            }
        });
    });



    function showCartDetails() {
        // Realizar una solicitud AJAX para obtener el resumen detallado del carrito
        $.ajax({
            type: 'GET',
            url: '../index.php?accio=actualizarCarrito',
            success: function(response) {
                // Actualizar el contenido con los detalles del carrito obtenidos
                console.log('AJAX Success:', response);
                $('tbody').html(response);
            },
            error: function(error) {
                console.log('AJAX Error:', error);
                console.log(error);
            }
        });
    }

    $(document).on('click', '#viewDetailsBtn', function() {
        // Llama a la función para mostrar el resumen detallado del carrito
        showCartDetails();
    });


    $(document).ready(function() {
        $(document).on('click', '#finishPurchaseBtn', function() {
            // Realizar una solicitud AJAX para finalizar la compra
            $.ajax({
                type: 'GET',
                url: '../controller/finish-purchase.php',
                success: function(response) {
                    alert(response); // Mostrar mensaje de éxito
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

    });

});