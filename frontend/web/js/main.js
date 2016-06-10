/**
 * Created by Sameh on 10/1/2015.
 */

cou=-1;



$(document).ready(function() {

   $('#search').on('click',function(){
       var phone=$("#phone").val();
        if($.trim(phone) !=''){
            /* thsi path to work on heroku not local*/
            $.post("/index.php?r=rtransaction/cust",
                {phone},function(data){
                   // alert(data);
                    var name= data.substr(0, data.indexOf('!'));
                    var address= data.substr(data.indexOf('!')+1);
                 $('#name').val(name);
                 $('#address').val(address);


                });

        }
   });

 $('#order-button').on('click',function(){
      var phone=$("#phone").val();
       var name=$("#name").val();
       var address=$("#address").val();
        if($.trim(phone) !=''&&$.trim(name) !=''&&$.trim(address) !=''){
            $.post("/index.php?r=rtransaction/add",
                {phone,name,address},function(data){
                   // alert(data);
                 /*   var name= data.substr(0, data.indexOf('!'));
                    var address= data.substr(data.indexOf('!')+1);
                 $('#name').val(name);
                 $('#address').val(address);*/


                });

        }

   });

    /*$("input").focus(function () {
     id = this.id;
     alert(id);
     });*/
    /* $("input").focus(function(){
     var f = $(this).attr("id");
     alert(f);
     });*/

if ($(".inv-item").length > 0) {

     $(document).on("click", ".form-control", function () {
            var clickedBtnID = $(this).attr('id'); // or var clickedBtnID = this.id


                    var $name_id = clickedBtnID;
                $(".inv-item").click(function () {

                    var val = $(this).val();

                    var item = ".field-" + $name_id + " option";
                    $(item).filter(function () {
                        return ($(this).val() == val); //To select Blue
                    }).prop('selected', true);
                    var sub = $name_id.substring(0, 14);
                    var sub_qty = "#" + sub + "-qty";
                    if ($(sub_qty).val() == "") {
                        $(sub_qty).val(1);
                        $qty_id = "";


                    }
                    $name_id = "";
                });


});
}
    else if ($("#order-button").length > 0) {
/*
$("#invoic1").click(function(){
   $("#delivary-form").toggle();
    $('.col-md-3').hide();
    $('.col-lg-3').hide();

});*/
$("#invoice-button").click(function(){
 $('.col-lg-3').printArea();
                   $('.col-lg-3').hide();
});

//transaction-3-qty

//transaction-0-item_item_id
        $(document).on("click", ".form-control", function () {
            var clickedBtnID = $(this).attr('id'); // or var clickedBtnID = this.id

            if(clickedBtnID.length == 27 && clickedBtnID.substring(0, 2)=="rt"){
                    var $name_id = clickedBtnID;
                $(".item-btn").click(function () {

                    var val = $(this).val();

                    var item = ".field-" + $name_id + " option";
                    $(item).filter(function () {
                        return ($(this).val() == val); //To select Blue
                    }).prop('selected', true);
                    var sub = $name_id.substring(0, 14);
                    var sub_qty = "#" + sub + "-qty";
                    if ($(sub_qty).val() == "") {
                        $(sub_qty).val(1);
                        $qty_id = "";


                    }
                    $name_id = "";
                });

            }
            else {
                var $qty_id = clickedBtnID;
                $(".qty").click(function () {
                       var qty = $(this).val();
                        var sqty_id = "#" + $qty_id;
                        //alert(sqty_id)
                        $(sqty_id).val(qty);
                        $qty_id = "";
                    }
                );
            }

            if(clickedBtnID.length == 27 && clickedBtnID.substring(0, 2)=="ct"){
                    var $name_id = clickedBtnID;
                $(".item-btn").click(function () {

                    var val = $(this).val();

                    var item = ".field-" + $name_id + " option"
                    $(item).filter(function () {
                        return ($(this).val() == val); //To select Blue
                    }).prop('selected', true);
                    var sub = $name_id.substring(0, 14);
                    var sub_qty = "#" + sub + "-qty";
                    if ($(sub_qty).val() == "") {
                        $(sub_qty).val(1);
                        $qty_id = ""


                    }
                    $name_id = ""
                });

            }
            else {
                var $qty_id = clickedBtnID;
                $(".qty").click(function () {
                       var qty = $(this).val();
                        var sqty_id = "#" + $qty_id;
                        //alert(sqty_id)
                        $(sqty_id).val(qty);
                        $qty_id = ""
                    }
                );
            }

             if (clickedBtnID.length == 28 ) {
                var $name_id = clickedBtnID;
                $(".item-btn").click(function () {

                    var val = $(this).val();

                    var item = ".field-" + $name_id + " option"
                    $(item).filter(function () {
                        return ($(this).val() == val); //To select Blue
                    }).prop('selected', true);
                    var sub = $name_id.substring(0, 15);
                    var sub_qty = "#" + sub + "-qty";
                    if ($(sub_qty).val() == "") {
                        $(sub_qty).val(1);
                        $qty_id = ""


                    }
                    $name_id = ""
                });

            }
            else {
                var $qty_id = clickedBtnID;
                $(".qty").click(function () {
                       var qty = $(this).val();
                        var sqty_id = "#" + $qty_id;
                        //alert(sqty_id)
                        $(sqty_id).val(5);
                        $qty_id = ""
                    }
                );
            }





        });

        $(document).keydown(function (e) {

            switch (e.keyCode) {
                case 13:


                   // $('#order-button').click();
                    $('.col-lg-3').printArea();
                   $('.col-lg-3').hide();
                break;


                case 107:
                    $('.add-item').click();
                    break;
                case 222:
                    $('.col-md-3').printArea();
                  //  $('.col-md-3').hide();

                    break;
            }
        });

    }
});

function isNumberKey(evt) {

    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

function popupCenter(pageURL, title, w, h) {
    var left = (screen.width / 2)  - (w / 2);
    var top  = (screen.height / 2) - (h / 2);
    var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
