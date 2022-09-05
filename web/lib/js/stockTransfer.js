/**
 * Created by sajib on 6/20/2015.
 */

var csrfToken = $('meta[name="csrf-token"]').attr("content");

$(function () {
    "use strict";

    $(document).on('pjax:timeout', function (event) {
        // Prevent default timeout redirection behavior
        event.preventDefault();
    });

    if ($.support.pjax) {
        $(document).on('click', 'button[data-pjax]', function (event) {
            event.preventDefault();
            var target = $(this).attr('value');
            $("#modal .modal-body").load(target, function () {
                $("#modal").modal("show");
            });
        });
    }

    $(document.body).on('change', '#size_id', function () {

        var sizeId = $('#size_id').val();
        if (sizeId) {
            $.ajax({
                url: priceUrl,
                type: 'POST',
                data: {sizeId: sizeId},
                success: function (response) {
                    if (response.success) {
                        $('#productstockitemsdraft-cost_price').val(response.cost);
                        $('#productstockitemsdraft-wholesale_price').val(response.wholesale);
                        $('#productstockitemsdraft-retail_price').val(response.retail);

                        $('#danger-message').hide();
                        $('#success-message').hide();
                        $('#success-message').empty();
                        $('#success-message').append(response.message);
                        $('#success-message').show(400);

                    } else {
                        $('#success-message').hide();
                        $('#danger-message').hide();
                        $('#danger-message').empty();
                        $('#danger-message').append(response.message);
                        $('#danger-message').show(400);
                        $('#productstockitemsdraft-cost_price').val(0);
                        $('#productstockitemsdraft-wholesale_price').val(0);
                        $('#productstockitemsdraft-retail_price').val(0);
                    }
                }
            });
        }
    });


    $('body').on('keypress', '#productstockitemsdraft-new_quantity', function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            //formAjaxSell
            $("form#formStockTransfer").on("submit", function (e) {

                event.preventDefault();

                var form = $(this);
                //console.log(form.serialize());
                // return false if form still have some validation errors
                if (form.find('.has-error').length) {
                    return false;
                }

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function (response) {
                        if (response.error) {
                            $("#errorSummary").empty();
                            $("#errorSummary").show();

                            var list = $("#errorSummary").append('<p>Please fix the following errors:</p><ul></ul>').find('ul');
                            $.each(response.message, function (index, value) {
                                list.append('<li>' + value + '</li>');
                            });

                        } else {
                            $("#errorSummary").hide();
                            $("#modal").modal("hide");
                            $.pjax.reload({container: '#stock', 'timeout': 5000});

                        }
                    }
                });
                return false;

            });
        }
    });


// $('body').on('beforeSubmit', 'form#formAjaxSaveStock', function (event) {
//
//
//     event.preventDefault();
//     var r = confirm("Do you want to create stock transfer?");
//     if (r === false) {
//         return false;
//     }
//
//     var form = $('#formAjaxSaveStock');
//     var type = $('#productstock-type').val();
//
//     var totalItem = $('#productstockitemsdraft-totalquantity').val();
//
//     if (totalItem == 0) {
//         $('#cartError').toggle(700);
//         return false;
//     }
//     return true;
// });


// //Add Product Stock Action
// $('body').on('beforeSubmit', 'form#formAjaxStock', function (event) {
//
//     event.preventDefault();
//
//     var form = $(this);
//
//     console.log(form.serialize());
//     // return false if form still have some validation errors
//     if (form.find('.has-error').length) {
//         console.log("Error");
//         console.log(form);
//
//         //return false;
//     }
//
//     // submit form
//     $.ajax({
//         url: form.attr('action'),
//         type: 'post',
//         data: form.serialize(),
//         success: function (response) {
//
//             if (response.error) {
//                 $("#errorSummary").empty();
//                 $("#errorSummary").show();
//
//                 var list = $("#errorSummary").append('<p>Please fix the following errors:</p><ul></ul>').find('ul');
//                 $.each(response.message, function (index, value) {
//                     list.append('<li>' + value + '</li>');
//                 });
//
//             } else {
//                 $("#errorSummary").hide();
//                 $.pjax.reload({container: '#stock', 'timeout': 10000});
//             }
//         }
//     });
//     return false;
// });
//
//
// $('body').on('beforeSubmit', 'form#formAjaxStockUpdate', function () {
//     var form = $(this);
//     //console.log(form.serialize());
//     // return false if form still have some validation errors
//     if (form.find('.has-error').length) {
//         return false;
//     }
//
//     // submit form
//     $.ajax({
//         url: form.attr('action'),
//         type: 'post',
//         data: form.serialize(),
//         success: function (response) {
//
//             if (response.error) {
//
//                 $("#errorSummary").empty();
//
//                 $("#errorSummary").show();
//
//                 var list = $("#errorSummary").append('<p>Please fix the following errors:</p><ul></ul>').find('ul');
//
//                 $.each(response.message, function (index, value) {
//                     list.append('<li>' + value + '</li>');
//                 });
//
//             } else {
//                 $("#errorSummary").hide();
//                 $("#modal .modal-body").load(form.attr('action'), function () {
//                     $("#modal").modal("show");
//                 });
//                 $.pjax.reload({container: '#stock', 'timeout': 10000}); // Reload GridView
//             }
//         }
//     });
//
//     return false;



 });
