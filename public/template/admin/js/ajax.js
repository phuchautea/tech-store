$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url) {
    if (confirm('Bạn không thể khôi phục sau khi xóa. Bạn chắc chắn xóa?')) {
        $.ajax({
            type: "DELETE",
            dataType: "JSON",
            data: { id },
            url: url,
            success: function (result) {
                alert(result.message);
                // if (result.error == false) {
                //     alert(result.message);
                // } else {
                //     alert(result.message);
                // }
                location.reload();
            }
        })
    }
}
