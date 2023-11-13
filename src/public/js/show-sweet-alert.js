const deleteButtons = document.querySelectorAll('.delete_button');

deleteButtons.forEach(function (button) {
    button.addEventListener('click', function (e) {
        e.preventDefault();
        const deleteForm = button.closest('.delete_form');
        const dataName = button.getAttribute('data-delete');
        Swal.fire({
            text: `Bạn có chắc muốn xoá ${dataName} này?`,
            icon: "warning",
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: "Có",
            cancelButtonText: "Huỷ",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger"
            },
        }).then((result) => {
            if (result.isConfirmed) {
                if (deleteForm) {
                    deleteForm.submit();
                }
            }
        });
    });
});
