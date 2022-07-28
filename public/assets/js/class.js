$(document).ready(function () {
    $(".firstln").removeClass("txtHide");
    $(".secondln").removeClass("txtHide");
    $(".thirdln").removeClass("txtHide");

    $(".firstln").addClass("ln1");
    $(".secondln").addClass("ln2");
    $(".thirdln").addClass("ln3");
});

$(document).on('click', '.postThis', function (e) {
    $('#userPost').submit();
});

$(document).on('click', '#imgUpload', function (e) {
    $('#up1_only').val('image');
});
$(document).on('click', '#vidUpload', function (e) {
    $('#up1_only').val('video');
});
$(document).on('click', '#gifUpload', function (e) {
    $('#up1_only').val('gif');
});

$(document).on('click', '.sidebarBtn', function (e) {
    var disVal = $(this).val();
    $('#sidebar_value').val(disVal);
    $('#sidebarForm').submit();
});

$(document).on('click', '#active', function (e) {
    if ($(this).is(':checked')) {
        $(this).val(1);
    } else {
        $(this).val(0);
    }
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#question_image').attr('src', e.target.result);
            $('#question_image').addClass('question_image');
            $('#question_image').removeAttr('hidden');
            $('#question_image').removeClass('hidden');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$('.remove').on('click', function () {
    $('#question_image').addClass('hidden');
    $('#question_image').attr('src', null);
});

$("#question_image_btn").change(function () {
    readURL(this);
});

$(document).on('click', '.add_option', function (e) {
    $('.multi_question:last').after('<div class="input-group multi_question flex_nowrap"><span class="input-group-addon Absolute-Center"><input type="checkbox" aria-label="..."></span><input type="text" class="form-control" aria-label="..."><button class="btn btn-danger removeOption"><i class="fa fa-close"></i></button></div>');
});

$(document).on('click', '.removeOption', function (e) {
    e.preventDefault();
    $(this).closest('.multi_question').remove();
});

$(document).on('click', '.editBtn', function (e) {
    var thisID = parseInt($(this).val());
    $.ajax({
        url: "/view_lesson",
        type: 'GET',
        data: { id: thisID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            var date1 = (data['thisLesson'][0]['date']);
            var dateSched = new Date(date1);
            dateSched.setDate(dateSched.getDate() + 1);
            var dateSched2 = dateSched.toISOString().substr(0, 10);

            $('#id').val(data['thisLesson'][0]['id']);
            $('#lesson_title').val(data['thisLesson'][0]['lesson_title']);
            $('#lesson_description').val(data['thisLesson'][0]['lesson_description']);
            $('#date').val(dateSched2);
            var status = data['thisLesson'][0]['active'];
            if (status == 1) {
                $('#active').attr('checked', 'true');
                $('#active').val(1);
            } else {
                $('#active').attr('checked', false);
                $('#active').val(0);
            }
            $('#lesson_plan').val(data['thisLesson'][0]['lesson_plan']);
            var base_url = window.location.origin;
            $('#addLesson').attr('action', base_url + "/edit_lesson")
            $('#addLesson').attr('method', 'POST')
        }
    });
});


$('#activity_type').on('click', function () {
    if (this.value == 1) {
        $(".multi_question_form").removeClass('hidden').addClass('show');
        $(".fill_question_form").addClass('hidden').find("input[type=text], textarea").val("");
        $(".true_false_question_form").addClass('hidden').find("input[type=text], textarea").val("");
    } else if (this.value == 2) {
        $(".multi_question_form").addClass('hidden');
        $(".fill_question_form").removeClass('hidden').addClass('show');
        $(".true_false_question_form").addClass('hidden');
    } else {
        $(".multi_question_form").addClass('hidden');
        $(".fill_question_form").addClass('hidden');
        $(".true_false_question_form").removeClass('hidden').addClass('show');
    }
});

$('.card-class').on('click', function () {
    alert( $(this).val() );
    $('#class_selector').val() = $(this).val();

    $('#class_selector').submit();
});




