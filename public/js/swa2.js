$(".swa2-confirm-delete").click(function (event) {
    let form = $(this).closest("form");
    event.preventDefault();
    Swal.fire({
        title: "Delete",
        text: "Apakah anda yakin ingin menghapus?",
        icon: "warning",
        showCancelButton: true,
        button: true,
        dangerMode: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
