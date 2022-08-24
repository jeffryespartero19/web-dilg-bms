///// Announcement Status
$(document).on('click', '.postThis_Ann_Status', function (e) {
    $('#newBRGY_Ann_Status').submit();
});

$(document).on('click', ('.edit_ann_status'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_bweb_ann_status_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_ann_status_idX').val(data['theEntry'][0]['Announcement_Status_ID']);
            $('#this_ann_statusX').val(data['theEntry'][0]['Announcement_Status']);

            $('#this_ann_status_active').empty();
            $('#this_ann_status_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_ann_status_active').append('Yes');
            } else {
                $('#this_ann_status_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Ann_Status', function (e) {
    $('#updateBRGY_Ann_Status').submit();
});



// Blood Type
//post buttons
$(document).on('click', '.postThis_Blood_Type', function (e) {
    $('#newBRGY_Blood_Type').submit();
});

$(document).on('click', ('.edit_blood_type'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_blood_type_maint",
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_blood_type_idX').val(data['theEntry'][0]['Blood_Type_ID']);
            $('#this_blood_typeX').val(data['theEntry'][0]['Blood_Type']);

            $('#this_blood_type_active').empty();
            $('#this_blood_type_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_blood_type_active').append('Yes');
            } else {
                $('#this_blood_type_active').append('No');
            }

        }
    });


});



/////// Announcement Type
$(document).on('click', '.postThis_Ann_Type', function (e) {
    $('#newBRGY_Ann_Type').submit();
});

$(document).on('click', ('.edit_ann_type'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_bweb_ann_type_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {

            $('#this_ann_type_idX').val(data['theEntry'][0]['Announcement_Type_ID']);
            $('#this_ann_type_NameX').val(data['theEntry'][0]['Announcement_Type_Name']);

            $('#this_ann_type_active').empty();
            $('#this_ann_type_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_ann_type_active').append('Yes');
            } else {
                $('#this_ann_type_active').append('No');
            }

        }
    });


});


$(document).on('click', '.updateThis_Blood_Type', function (e) {
    $('#updateBRGY_Blood_Type').submit();
});


// Deceased Type
//post buttons
$(document).on('click', '.postThis_Deceased_Type', function (e) {
    $('#newBRGY_Deceased_Type').submit();
});

$(document).on('click', ('.edit_deceased_type'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_deceased_type_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_deceased_type_idX').val(data['theEntry'][0]['Deceased_Type_ID']);
            $('#this_deceased_typeX').val(data['theEntry'][0]['Deceased_Type']);

            $('#this_deceased_type_active').empty();
            $('#this_deceased_type_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_deceased_type_active').append('Yes');
            } else {
                $('#this_deceased_type_active').append('No');
            }

        }
    });


});



$(document).on('click', '.updateThis_News_Type', function (e) {
    $('#updateBRGY_News_Type').submit();
});

///// News Status
$(document).on('click', '.postThis_News_Status', function (e) {
    $('#newBRGY_News_Status').submit();
});

$(document).on('click', ('.edit_news_status'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_bweb_news_status_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_news_status_idX').val(data['theEntry'][0]['News_Status_ID']);
            $('#this_news_statusX').val(data['theEntry'][0]['News_Status']);

            $('#this_news_status_active').empty();
            $('#this_news_status_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_news_status_active').append('Yes');
            } else {
                $('#this_news_status_active').append('No');
            }

        }
    });


});


$(document).on('click', '.updateThis_Deceased_Type', function (e) {
    $('#updateBRGY_Deceased_Type').submit();
});


// Civil Status
//post buttons
$(document).on('click', '.postThis_Civil_Status', function (e) {
    $('#newBRGY_Civil_Status').submit();
});

$(document).on('click', ('.edit_civil_status'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_civil_status_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_civil_status_idX').val(data['theEntry'][0]['Civil_Status_ID']);
            $('#this_civil_statusX').val(data['theEntry'][0]['Civil_Status']);

            $('#this_civil_status_active').empty();
            $('#this_civil_status_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_civil_status_active').append('Yes');
            } else {
                $('#this_civil_status_active').append('No');
            }

        }
    });
});






$(document).on('click', '.updateThis_News_Status', function (e) {
    $('#updateBRGY_News_Status').submit();
});


/////// News Type
$(document).on('click', '.postThis_News_Type', function (e) {
    $('#newBRGY_News_Type').submit();
});

$(document).on('click', ('.edit_news_type'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_bweb_news_type_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {

            $('#this_news_type_idX').val(data['theEntry'][0]['News_Type_ID']);
            $('#this_news_type_NameX').val(data['theEntry'][0]['News_Type_Name']);

            $('#this_news_type_active').empty();
            $('#this_news_type_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_news_type_active').append('Yes');
            } else {
                $('#this_news_type_active').append('No');
            }

        }
    });


});


$(document).on('click', '.updateThis_Civil_Status', function (e) {
    $('#updateBRGY_Civil_Status').submit();
});

// Name Prefix
//post buttons
$(document).on('click', '.postThis_Name_Prefix', function (e) {
    $('#newBRGY_Name_Prefix').submit();
});

$(document).on('click', ('.edit_name_prefix'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_name_prefix_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_name_prefix_idX').val(data['theEntry'][0]['Name_Prefix_ID']);
            $('#this_name_prefixX').val(data['theEntry'][0]['Name_Prefix']);

            $('#this_name_prefix_active').empty();
            $('#this_name_prefix_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_name_prefix_active').append('Yes');
            } else {
                $('#this_name_prefix_active').append('No');
            }

        }
    });


});



$(document).on('click', '.updateThis_Name_Prefix', function (e) {
    $('#updateBRGY_Name_Prefix').submit();
});

// Family Position
//post buttons
$(document).on('click', '.postThis_Family_Position', function (e) {
    $('#newBRGY_Family_Position').submit();
});

$(document).on('click', ('.edit_family_position'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_family_position_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_family_position_idX').val(data['theEntry'][0]['Family_Position_ID']);
            $('#this_family_positionX').val(data['theEntry'][0]['Family_Position']);

            $('#this_family_position_active').empty();
            $('#this_family_position_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_family_position_active').append('Yes');
            } else {
                $('#this_family_position_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Family_Position', function (e) {
    $('#updateBRGY_Family_Position').submit();
});

// academic level
//post buttons
$(document).on('click', '.postThis_Academic_Level', function (e) {
    $('#newBRGY_Academic_Level').submit();
});

$(document).on('click', ('.edit_academic_level'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_academic_level_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_academic_level_idX').val(data['theEntry'][0]['Academic_Level_ID']);
            $('#this_academic_levelX').val(data['theEntry'][0]['Academic_Level']);

            $('#this_academic_level_active').empty();
            $('#this_academic_level_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_academic_level_active').append('Yes');
            } else {
                $('#this_academic_level_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Academic_Level', function (e) {
    $('#updateBRGY_Academic_Level').submit();
});

// Housing Unit
//post buttons
$(document).on('click', '.postThis_Housing_Unit', function (e) {
    $('#newBRGY_Housing_Unit').submit();
});

$(document).on('click', ('.edit_housing_unit'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_housing_unit_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_housing_unit_idX').val(data['theEntry'][0]['Housing_Unit_ID']);
            $('#this_housing_unitX').val(data['theEntry'][0]['Housing_Unit']);

            $('#this_housing_unit_active').empty();
            $('#this_housing_unit_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_housing_unit_active').append('Yes');
            } else {
                $('#this_housing_unit_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Housing_Unit', function (e) {
    $('#updateBRGY_Housing_Unit').submit();
});

// Religion
//post buttons
$(document).on('click', '.postThis_Religion', function (e) {
    $('#newBRGY_Religion').submit();
});

$(document).on('click', ('.edit_religion'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_religion_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_religion_idX').val(data['theEntry'][0]['Religion_ID']);
            $('#this_religionX').val(data['theEntry'][0]['Religion']);

            $('#this_religion_active').empty();
            $('#this_religion_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_religion_active').append('Yes');
            } else {
                $('#this_religion_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Religion', function (e) {
    $('#updateBRGY_Religion').submit();
});

// Family Type
//post buttons
$(document).on('click', '.postThis_Family_Type', function (e) {
    $('#newBRGY_Family_Type').submit();
});

$(document).on('click', ('.edit_family_type'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_family_type_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_family_type_idX').val(data['theEntry'][0]['Family_Type_ID']);
            $('#this_family_typeX').val(data['theEntry'][0]['Family_Type_Name']);

            $('#this_family_type_active').empty();
            $('#this_family_type_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_family_type_active').append('Yes');
            } else {
                $('#this_family_type_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Family_Type', function (e) {
    $('#updateBRGY_Family_Type').submit();
});

// Emplyment Type
//post buttons
$(document).on('click', '.postThis_Employment_Type', function (e) {
    $('#newBRGY_Employment_Type').submit();
});

$(document).on('click', ('.edit_employment_type'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_employment_type_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_employment_type_idX').val(data['theEntry'][0]['Employment_Type_ID']);
            $('#this_employment_typeX').val(data['theEntry'][0]['Employment_Type']);

            $('#this_employment_type_active').empty();
            $('#this_employment_type_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_employment_type_active').append('Yes');
            } else {
                $('#this_employment_type_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Employment_Type', function (e) {
    $('#updateBRGY_Employment_Type').submit();
});

// Tenure of Lot
//post buttons
$(document).on('click', '.postThis_Tenure_of_Lot', function (e) {
    $('#newBRGY_Tenure_of_Lot').submit();
});

$(document).on('click', ('.edit_tenure_of_lot'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_tenure_of_lot_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_tenure_of_lot_idX').val(data['theEntry'][0]['Tenure_of_Lot_ID']);
            $('#this_tenure_of_lotX').val(data['theEntry'][0]['Tenure_of_Lot']);

            $('#this_tenure_of_lot_active').empty();
            $('#this_tenure_of_lot_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_tenure_of_lot_active').append('Yes');
            } else {
                $('#this_tenure_of_lot_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Tenure_of_Lot', function (e) {
    $('#updateBRGY_Tenure_of_Lot').submit();
});

// Name Suffix
//post buttons
$(document).on('click', '.postThis_Name_Suffix', function (e) {
    $('#newBRGY_Name_Suffix').submit();
});

$(document).on('click', ('.edit_name_suffix'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_name_suffix_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_name_suffix_idX').val(data['theEntry'][0]['Name_Suffix_ID']);
            $('#this_name_suffixX').val(data['theEntry'][0]['Name_Suffix']);

            $('#this_name_suffix_active').empty();
            $('#this_name_suffix_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_name_suffix_active').append('Yes');
            } else {
                $('#this_name_suffix_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Name_Suffix', function (e) {
    $('#updateBRGY_Name_Suffix').submit();
});

// Project Typee
//post buttons
$(document).on('click', '.postThis_Project_Type', function (e) {
    $('#newBRGY_Project_Type').submit();
});

$(document).on('click', ('.edit_project_type'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_project_type_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_project_type_idX').val(data['theEntry'][0]['Project_Type_ID']);
            $('#this_project_typeX').val(data['theEntry'][0]['Project_Type_Name']);

            $('#this_project_type_active').empty();
            $('#this_project_type_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_project_type_active').append('Yes');
            } else {
                $('#this_project_type_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Project_Type', function (e) {
    $('#updateBRGY_Project_Type').submit();
});

// Accomplishment Status
//post buttons
$(document).on('click', '.postThis_Accomplishment_Status', function (e) {
    $('#newBRGY_Accomplishment_Status').submit();
});

$(document).on('click', ('.edit_accomplishment_status'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_accomplishment_status_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_accomplishment_status_idX').val(data['theEntry'][0]['Accomplishment_Status_ID']);
            $('#this_accomplishment_statusX').val(data['theEntry'][0]['Accomplishment_Status_Name']);

            $('#this_accomplishment_status_active').empty();
            $('#this_accomplishment_status_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_accomplishment_status_active').append('Yes');
            } else {
                $('#this_accomplishment_status_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Accomplishment_Status', function (e) {
    $('#updateBRGY_Accomplishment_Status').submit();
});


// Project Status
//post buttons
$(document).on('click', '.postThis_Project_Status', function (e) {
    $('#newBRGY_Project_Status').submit();
});

$(document).on('click', ('.edit_project_status'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_project_status_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_project_status_idX').val(data['theEntry'][0]['Project_Status_ID']);
            $('#this_project_statusX').val(data['theEntry'][0]['Project_Status_Name']);

            $('#this_project_status_active').empty();
            $('#this_project_status_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_project_status_active').append('Yes');
            } else {
                $('#this_project_status_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Project_Status', function (e) {
    $('#updateBRGY_Project_Status').submit();
});


// Type of Ordinance
//post buttons
$(document).on('click', '.postThis_Type_of_Ordinance', function (e) {
    $('#newBRGY_Type_of_Ordinance').submit();
});

$(document).on('click', ('.edit_type_of_ordinance'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_type_of_ordinance_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_type_of_ordinance_idX').val(data['theEntry'][0]['Type_of_Ordinance_or_Resolution_ID']);
            $('#this_type_of_ordinanceX').val(data['theEntry'][0]['Name_of_Type']);

            $('#this_type_of_ordinance_active').empty();
            $('#this_type_of_ordinance_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_type_of_ordinance_active').append('Yes');
            } else {
                $('#this_type_of_ordinance_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Type_of_Ordinance', function (e) {
    $('#updateBRGY_Type_of_Ordinance').submit();
});

// Ordiance Category
//post buttons
$(document).on('click', '.postThis_Ordinance_Category', function (e) {
    $('#newBRGY_Ordinance_Category').submit();
});

$(document).on('click', ('.edit_ordinance_category'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_ordinance_category_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_ordinance_category_idX').val(data['theEntry'][0]['Ordinance_Category_ID']);
            $('#this_ordinance_categoryX').val(data['theEntry'][0]['Ordinance_Category_Name']);

            $('#this_ordinance_category_active').empty();
            $('#this_ordinance_category_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_ordinance_category_active').append('Yes');
            } else {
                $('#this_ordinance_category_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Ordinance_Category', function (e) {
    $('#updateBRGY_Ordinance_Category').submit();
});

// Status of Ordinance
//post buttons
$(document).on('click', '.postThis_Status_of_Ordinance', function (e) {
    $('#newBRGY_Status_of_Ordinance').submit();
});

$(document).on('click', ('.edit_status_of_ordinance'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_status_of_ordinance_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_status_of_ordinance_idX').val(data['theEntry'][0]['Status_of_Ordinance_ID']);
            $('#this_status_of_ordinanceX').val(data['theEntry'][0]['Status_of_Ordinance_Name']);

            $('#this_status_of_ordinance_active').empty();
            $('#this_status_of_ordinance_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_status_of_ordinance_active').append('Yes');
            } else {
                $('#this_status_of_ordinance_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Status_of_Ordinance', function (e) {
    $('#updateBRGY_Status_of_Ordinance').submit();
});

// Alert Level
//post buttons
$(document).on('click', '.postThis_Alert_Level', function (e) {
    $('#newBRGY_Alert_Level').submit();
});

$(document).on('click', ('.edit_alert_level'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_alert_level_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_alert_level_idX').val(data['theEntry'][0]['Alert_Level_ID']);
            $('#this_alert_levelX').val(data['theEntry'][0]['Alert_Level']);

            $('#this_alert_level_active').empty();
            $('#this_alert_level_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_alert_level_active').append('Yes');
            } else {
                $('#this_alert_level_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Alert_Level', function (e) {
    $('#updateBRGY_Alert_Level').submit();
});

// Level of Damage
//post buttons
$(document).on('click', '.postThis_Level_of_Damage', function (e) {
    $('#newBRGY_Level_of_Damage').submit();
});

$(document).on('click', ('.edit_level_of_damage'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_level_of_damage_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_level_of_damage_idX').val(data['theEntry'][0]['Level_of_Damage_ID']);
            $('#this_level_of_damageX').val(data['theEntry'][0]['Level_of_Damage']);

            $('#this_level_of_damage_active').empty();
            $('#this_level_of_damage_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_level_of_damage_active').append('Yes');
            } else {
                $('#this_level_of_damage_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Level_of_Damage', function (e) {
    $('#updateBRGY_Level_of_Damage').submit();
});

// Casualties Status
//post buttons
$(document).on('click', '.postThis_Casualty_Status', function (e) {
    $('#newBRGY_Casualty_Status').submit();
});

$(document).on('click', ('.edit_casualty_status'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_casualty_status_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_casualty_status_idX').val(data['theEntry'][0]['Casualty_Status_ID']);
            $('#this_casualty_statusX').val(data['theEntry'][0]['Casualty_Status']);

            $('#this_casualty_status_active').empty();
            $('#this_casualty_status_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_casualty_status_active').append('Yes');
            } else {
                $('#this_casualty_status_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Casualty_Status', function (e) {
    $('#updateBRGY_Casualty_Status').submit();
});









// Case Type
//post buttons
$(document).on('click', '.postThis_Case_Type', function (e) {
    $('#newBRGY_Case_Type').submit();
});

$(document).on('click', ('.edit_case_type'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_case_type_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_case_type_idX').val(data['theEntry'][0]['Case_Type_ID']);
            $('#this_case_typeX').val(data['theEntry'][0]['Case_Type_Name']);

            $('#this_case_type_active').empty();
            $('#this_case_type_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_case_type_active').append('Yes');
            } else {
                $('#this_case_type_active').append('No');
            }

        }
    });
});

$(document).on('click', '.updateThis_Case_Type', function (e) {
    $('#updateBRGY_Case_Type').submit();
});


// Case
//post buttons
$(document).on('click', '.postThis_Case', function (e) {
    $('#newBRGY_Case').submit();
});

$(document).on('click', ('.edit_case'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_case_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_case_idX').val(data['theEntry'][0]['Case_ID']);
            $('#this_caseX').val(data['theEntry'][0]['Case_Name']);
            $('#case_type_idX2').val(data['theEntry'][0]['Case_Type_ID']);
            $('#this_case_active').empty();
            $('#this_case_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_case_active').append('Yes');
            } else {
                $('#this_case_active').append('No');
            }

        }
    });
});

$(document).on('click', '.updateThis_Case', function (e) {
    $('#updateBRGY_Case').submit();
});

// Type of Involved Party
//post buttons
$(document).on('click', '.postThis_Type_of_Involved_Party', function (e) {
    $('#newBRGY_Type_of_Involved_Party').submit();
});

$(document).on('click', ('.edit_type_of_involved_party'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_type_of_involved_party_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_type_of_involved_party_idX').val(data['theEntry'][0]['Type_of_Involved_Party_ID']);
            $('#this_type_of_involved_partyX').val(data['theEntry'][0]['Type_of_Involved_Party']);

            $('#this_type_of_involved_party_active').empty();
            $('#this_type_of_involved_party_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_type_of_involved_party_active').append('Yes');
            } else {
                $('#this_type_of_involved_party_active').append('No');
            }

        }
    });
});

$(document).on('click', '.updateThis_Type_of_Involved_Party', function (e) {
    $('#updateBRGY_Type_of_Involved_Party').submit();
});


// Violation Status
//post buttons
$(document).on('click', '.postThis_Violation_Status', function (e) {
    $('#newBRGY_Violation_Status').submit();
});

$(document).on('click', ('.edit_violation_status'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_violation_status_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_violation_status_idX').val(data['theEntry'][0]['Violation_Status_ID']);
            $('#this_violation_statusX').val(data['theEntry'][0]['Violation_Status']);

            $('#this_violation_status_active').empty();
            $('#this_violation_status_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_violation_status_active').append('Yes');
            } else {
                $('#this_violation_status_active').append('No');
            }

        }
    });
});

$(document).on('click', '.updateThis_Violation_Status', function (e) {
    $('#updateBRGY_Violation_Status').submit();
});

// Summons Status
//post buttons
$(document).on('click', '.postThis_Summons_Status', function (e) {
    $('#newBRGY_Summons_Status').submit();
});

$(document).on('click', ('.edit_summons_status'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_summons_status_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_summons_status_idX').val(data['theEntry'][0]['Summons_Status_ID']);
            $('#this_summons_statusX').val(data['theEntry'][0]['Type_of_Action']);

            $('#this_summons_status_active').empty();
            $('#this_summons_status_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_summons_status_active').append('Yes');
            } else {
                $('#this_summons_status_active').append('No');
            }

        }
    });
});

$(document).on('click', '.updateThis_Summons_Status', function (e) {
    $('#updateBRGY_Summons_Status').submit();
});

// Service Rate
//post buttons
$(document).on('click', '.postThis_Service_Rate', function (e) {
    $('#newBRGY_Service_Rate').submit();
});

$(document).on('click', ('.edit_service_rate'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_service_rate_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_service_rate_idX').val(data['theEntry'][0]['Service_Rate_ID']);
            $('#this_service_rateX').val(data['theEntry'][0]['Service_Rate']);

            $('#this_service_rate_active').empty();
            $('#this_service_rate_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_service_rate_active').append('Yes');
            } else {
                $('#this_service_rate_active').append('No');
            }

        }
    });
});

$(document).on('click', '.updateThis_Service_Rate', function (e) {
    $('#updateBRGY_Service_Rate').submit();
});

// Proceedings Status
//post buttons
$(document).on('click', '.postThis_Proceedings_Status', function (e) {
    $('#newBRGY_Proceedings_Status').submit();
});

$(document).on('click', ('.edit_proceedings_status'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_proceedings_status_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_proceedings_status_idX').val(data['theEntry'][0]['Proceedings_Status_ID']);
            $('#this_proceedings_statusX').val(data['theEntry'][0]['Type_of_Action']);

            $('#this_proceedings_status_active').empty();
            $('#this_proceedings_status_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_proceedings_status_active').append('Yes');
            } else {
                $('#this_proceedings_status_active').append('No');
            }

        }
    });
});

$(document).on('click', '.updateThis_Proceedings_Status', function (e) {
    $('#updateBRGY_Proceedings_Status').submit();
});

// Type of Action
//post buttons
$(document).on('click', '.postThis_Type_of_Action', function (e) {
    $('#newBRGY_Type_of_Action').submit();
});

$(document).on('click', ('.edit_type_of_action'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_type_of_action_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_type_of_action_idX').val(data['theEntry'][0]['Type_of_Action_ID']);
            $('#this_type_of_actionX').val(data['theEntry'][0]['Type_of_Action']);

            $('#this_type_of_action_active').empty();
            $('#this_type_of_action_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_type_of_action_active').append('Yes');
            } else {
                $('#this_type_of_action_active').append('No');
            }

        }
    });
});

$(document).on('click', '.updateThis_Type_of_Action', function (e) {
    $('#updateBRGY_Type_of_Action').submit();
});

// Type of Penalties
//post buttons
$(document).on('click', '.postThis_Type_of_Penalties', function (e) {
    $('#newBRGY_Type_of_Penalties').submit();
});

$(document).on('click', ('.edit_type_of_penalties'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_type_of_penalties_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_type_of_penalties_idX').val(data['theEntry'][0]['Types_of_Penalties_ID']);
            $('#this_type_of_penaltiesX').val(data['theEntry'][0]['Type_of_Penalties']);

            $('#this_type_of_penalties_active').empty();
            $('#this_type_of_penalties_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_type_of_penalties_active').append('Yes');
            } else {
                $('#this_type_of_penalties_active').append('No');
            }

        }
    });
});

$(document).on('click', '.updateThis_Type_of_Penalties', function (e) {
    $('#updateBRGY_Type_of_Penalties').submit();
});


// Blotter Status
//post buttons
$(document).on('click', '.postThis_Blotter_Status', function (e) {
    $('#newBRGY_Blotter_Status').submit();
});

$(document).on('click', ('.edit_blotter_status'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_blotter_status_maint",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_blotter_status_idX').val(data['theEntry'][0]['Blotter_Status_ID']);
            $('#this_blotter_statusX').val(data['theEntry'][0]['Blotter_Status_Name']);

            $('#this_blotter_status_active').empty();
            $('#this_blotter_status_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_blotter_status_active').append('Yes');
            } else {
                $('#this_blotter_status_active').append('No');
            }

        }
    });
});

$(document).on('click', '.updateThis_Blotter_Status', function (e) {
    $('#updateBRGY_Blotter_Status').submit();
});

