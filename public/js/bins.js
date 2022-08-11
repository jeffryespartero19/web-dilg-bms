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

    if(ident == 8){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bins_received_item",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_received_item_IdX').val(data['theEntry'][0]['Received_Item_ID']);

                $('#this_item_idX').empty();
                $('#this_item_idX').val(data['the_item'][0]['Inventory_ID']);

                $('#this_item_status_idX').empty();
                $('#this_item_status_idX').val(data['theitem_status'][0]['Item_Status_ID']);
                $('#this_item_status_idX').append(data['theitem_status'][0]['Item_Status']);

                $('#this_donationX').empty();
                $('#this_donationX').val(data['theEntry'][0]['Donation']);
                if(data['theEntry'][0]['Donation']==1){
                    $('#this_donationX').append('Yes');

                }else{
                    $('#this_donationX').append('No');
                }

                $('#this_rc_byX').empty();
                $('#this_rc_byX').val(data['thestaff'][0]['Brgy_Officials_and_Staff_ID']);

                $('#this_received_qtyX').val(data['theEntry'][0]['Received_Quantity']);
           
            }
        });
    }

    if(ident == 9){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bins_physical_count",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_physical_count_IdX').val(data['theEntry'][0]['Physical_Count_ID']);

                $('#this_p_inv').empty();
                $('#this_p_inv').val(data['theP_inventory'][0]['Physical_Count_Inventory_ID']);

                $('#this_item_category').empty();
                $('#this_item_category').val(data['theitem_category'][0]['Item_Category_ID']);
                $('#this_item_category').append(data['theitem_category'][0]['Item_Category_Name']);

                $('#this_particulars').empty();
                $('#this_particulars').append(data['theEntry'][0]['Particulars']);
                

                $('#this_oic').empty();
                $('#this_oic').val(data['thestaff'][0]['Brgy_Officials_and_Staff_ID']);
           
            }
        });
    }

    if(ident == 10){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bins_inv_disposal",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_inv_disposal_IdX').val(data['theEntry'][0]['Disposal_Inventory_ID']);

                $('#this_item_idX').empty();
                $('#this_item_idX').val(data['the_item'][0]['Inventory_ID']);

                $('#this_item_status_idX').empty();
                $('#this_item_status_idX').val(data['theitem_status'][0]['Item_Status_ID']);
                $('#this_item_status_idX').append(data['theitem_status'][0]['Item_Status']);

                $('#this_remarks').empty();
                $('#this_remarks').append(data['theEntry'][0]['Remarks']);
                

                $('#this_oic').empty();
                $('#this_oic').val(data['thestaff'][0]['Brgy_Officials_and_Staff_ID']);
           
            }
        });
    }

    if(ident == 11){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bins_borrow",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_inv_disposal_IdX').val(data['theEntry'][0]['Borrowed_Equipment_ID ']);

                $('#this_item_idX').empty();
                $('#this_item_idX').val(data['the_item'][0]['Inventory_ID']);

                $('#this_item_status_idX').empty();
                $('#this_item_status_idX').val(data['theitem_status'][0]['Item_Status_ID']);
                $('#this_item_status_idX').append(data['theitem_status'][0]['Item_Status']);

                $('#this_remarks').empty();
                $('#this_remarks').append(data['theRequest'][0]['Remarks']);

                $('#this_pupose').empty();
                $('#this_pupose').append(data['theRequest'][0]['Purpose']);
                
                $('#thisBorrowDate').val(data['theRequest'][0]['Date_Borrowed']);
                $('#thisEstReturnDate').val(data['theRequest'][0]['Expected_Return_Date']);

                $('#this_qty_borrowed').val(data['theEntry'][0]['Quantity_Borrowed']);
                
           
            }
        });
    }

    
});


