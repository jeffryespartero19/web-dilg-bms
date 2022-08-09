///// 
$(document).on('click','.postThis_XYZ',function(e) {
    $('#newEntryXYZ').submit(); 
});

$(document).on('click','.updateThis_XYZ',function(e) {
    $('#updateEntryXYZ').submit(); 
});


$(document).on('click',('.edit_XYZ'),function(e) {
    var ident =$('#this_identifier').val();
    
    if(ident == 1){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bins_uom_maint",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_uom_idX').val(data['theEntry'][0]['Unit_of_Measure_ID']);
                $('#this_uomX').val(data['theEntry'][0]['Unit_of_Measure']);
                
                $('#this_uom_active').empty();
                $('#this_uom_active').val(data['theEntry'][0]['Active']);
                if(data['theEntry'][0]['Active']==1){
                    $('#this_uom_active').append('Yes');
                }else{
                    $('#this_uom_active').append('No');
                }

            }
        });
    }

    if(ident == 2){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bins_bes_maint",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_bes_idX').val(data['theEntry'][0]['Borrowed_Equipment_Status_ID']);
                $('#this_besX').val(data['theEntry'][0]['Equipment_Status']);
                
                $('#this_bes_active').empty();
                $('#this_bes_active').val(data['theEntry'][0]['Active']);
                if(data['theEntry'][0]['Active']==1){
                    $('#this_bes_active').append('Yes');
                }else{
                    $('#this_bes_active').append('No');
                }

            }
        });
    }

    if(ident == 3){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bins_item_class_maint",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_item_class_idX').val(data['theEntry'][0]['Item_Classification_ID']);
                $('#this_item_classX').val(data['theEntry'][0]['Item_Classification']);
                
                $('#this_item_class_active').empty();
                $('#this_item_class_active').val(data['theEntry'][0]['Active']);
                if(data['theEntry'][0]['Active']==1){
                    $('#this_item_class_active').append('Yes');
                }else{
                    $('#this_item_class_active').append('No');
                }

            }
        });
    }

    if(ident == 4){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bins_item_status_maint",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_item_status_idX').val(data['theEntry'][0]['Item_Status_ID']);
                $('#this_item_statusX').val(data['theEntry'][0]['Item_Status']);
                
                $('#this_item_status_active').empty();
                $('#this_item_status_active').val(data['theEntry'][0]['Active']);
                if(data['theEntry'][0]['Active']==1){
                    $('#this_item_status_active').append('Yes');
                }else{
                    $('#this_item_status_active').append('No');
                }

            }
        });
    }

    if(ident == 5){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bins_item_category_maint",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_item_category_idX').val(data['theEntry'][0]['Item_Category_ID']);
                $('#this_item_categoryX').val(data['theEntry'][0]['Item_Category_Name']);
                
                $('#this_item_category_active').empty();
                $('#this_item_category_active').val(data['theEntry'][0]['Active']);
                if(data['theEntry'][0]['Active']==1){
                    $('#this_item_category_active').append('Yes');
                }else{
                    $('#this_item_category_active').append('No');
                }

                $('#this_item_class').empty();
                $('#this_item_class').val(data['thisEntry_item_class'][0]['Item_Classification_ID']);
                $('#this_item_class').append(data['thisEntry_item_class'][0]['Item_Classification']);
                

            }
        });
    }

    if(ident == 6){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bins_begbal",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#Inventory_BegBal_ID').val(data['theEntry'][0]['Item_Category_ID']);
                $('#this_item_unit_cost').val(data['theEntry'][0]['Unit_Cost']);
                $('#this_item_qty').val(data['theEntry'][0]['Quantity']);
           
            }
        });
    }

    if(ident == 7){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bins_item_inspection",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_rci_idX').empty();
                $('#this_rci_idX').val(data['theRC_item'][0]['Received_Item_ID']);

                $('#this_markingsX').val(data['theEntry'][0]['Markings']);
                $('#this_serial_noX').val(data['theEntry'][0]['Serial_No']);

                $('#this_item_statusX').empty();
                $('#this_item_statusX').val(data['theitem_status'][0]['Item_Status_ID']);
                $('#this_item_statusX').append(data['theitem_status'][0]['Item_Status']);
           
            }
        });
    }

    
});

