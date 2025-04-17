const sortList = {idSort: 'id', dateSort: 'date'}
let loadingComments = false;
$("#comment-form").on("submit", function(event) {
    event.preventDefault();
    $('.toast').hide();
    if (!loadingComments) {
        loadingComments = true;
        if (typeof($('.comment.update')[0]) === 'undefined') {
            $.ajax({
                url: '/api/comments/create',
                method: 'POST',
                data: $("#comment-form").serialize(),
                success: function(data)  {
                    $('#comment-form'). trigger('reset');
                    getCommentsPage($('.page-item.active')[0].value, orderBy ?? null, direction ?? null);
                },
                error: function (data) {
                    loadingComments = false;
                    $('.toast')[0].innerText = data.responseJSON.messages.name;
                    $('.toast').show();
                }
            })
        } else {
            $.ajax({
                url: '/api/comments/update',
                method: 'POST',
                data: $("#comment-form").serialize(),
                success: function(data)  {
                    $('#idForm').attr('disabled','disabled');
                    $(".btn-danger", $("#comment-form")).attr('disabled','disabled');
                    $('#comment-form'). trigger('reset');
                    $('.comment.update').addClass('update').removeClass('update');
                    getCommentsPage($('.page-item.active')[0].value, orderBy ?? null, direction ?? null);
                },
                error: function (data) {
                    loadingComments = false;
                    $('.toast')[0].innerText = data.responseJSON.messages.name;
                    $('.toast').show();
                }
            })
        }
    }
});

function getCommentsPage(page, orderBy = 'id', direction = 'asc') {
    $.ajax({
        url: '/api/comments/read',
        method: 'GET',
        dataType: 'html',
        data: {
            page: page,
            orderBy: orderBy,
            direction: direction,
        },
        success: function(data)  {
            $('#comments-list')[0].innerHTML = data;
            loadingComments = false;
        }
    })
}

$("#comments-list").on("click", ".buttom-sort", function(event) {
    if (!loadingComments) {
        loadingComments = true;
        const order = event.currentTarget.id
        const i = $('i.bi', event.currentTarget)[0];
        if (typeof(i) != 'undefined') {
            if (i.classList.contains('bi-caret-up')) {
                getCommentsPage($('.page-item.active')[0].value, sortList[order], 'desc');
                direction = 'desc';
            } else {
                getCommentsPage($('.page-item.active')[0].value, sortList[order], 'asc');
                direction = 'asc';
            }
        } else {
            getCommentsPage($('.page-item.active')[0].value, sortList[order], 'asc');
            direction = 'asc';
        }
        orderBy = sortList[order];
    }
});

$("#comments-list").on("click", ".page-item:not(.active)", function(event) {
    if (!loadingComments) {
        loadingComments = true;
        getCommentsPage(event.currentTarget.value, orderBy ?? null, direction ?? null);
    }
});

$("#comments-list").on("click", ".btn-close", function(event) {
    if (!loadingComments) {
        loadingComments = true;
        $.ajax({
            url: '/api/comments/delete',
            method: 'POST',
            data: {
                id: event.currentTarget.id,
            },
            success: function(data)  {
                getCommentsPage($('.page-item.active')[0].value, orderBy ?? null, direction ?? null);
            }
        })
        loadingComments = false;
    }
});

$("#comments-list").on("click", ".btn-update", function(event) {
    $('.comment.update').addClass('update').removeClass('update');
    $('#idForm').removeAttr('disabled');
    $('.btn-danger', $("#comment-form")).removeAttr('disabled');
    $('#idForm')[0].value = event.currentTarget.id;
    $('#' + event.currentTarget.id + '.comment').addClass('update');
    $('#name')[0].value = $("#name" + event.currentTarget.id, $('#' + event.currentTarget.id + '.comment'))[0].innerText;
    $('#text')[0].value = $("#text" + event.currentTarget.id, $('#' + event.currentTarget.id + '.comment'))[0].innerText;
    $('#date')[0].value = $("#date" + event.currentTarget.id, $('#' + event.currentTarget.id + '.comment'))[0].innerText;
});

$("#comment-form").on("click", ".btn-danger", function(event) {
    event.preventDefault();
    $(".btn-danger", $("#comment-form")).attr('disabled','disabled');
    $('.comment.update').addClass('update').removeClass('update');
    $('#comment-form'). trigger('reset');
})
