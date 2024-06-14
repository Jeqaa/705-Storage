console.log("AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA;");

// Add item
document
    .getElementById("addItemBtn")
    .addEventListener("click", function (event) {
        // alert("tes");
        document.getElementById("myForm").style.display = "block"; // Menampilkan form
        document.getElementById("modalOverlay").style.display = "block"; /// Menampilkan overlay
        event.preventDefault(); // Mencegah tautan untuk mengikuti href #
    });

// JavaScript untuk menyembunyikan form dan overlay ketika klik di luar form atau klik tombol Cancel
document.getElementById("modalOverlay").addEventListener("click", function () {
    document.getElementById("myForm").style.display = "none";
    document.getElementById("modalOverlay").style.display = "none";
});

document.getElementById("cancelBtn").addEventListener("click", function () {
    document.getElementById("myForm").style.display = "none";
    document.getElementById("modalOverlay").style.display = "none";
});

// Mencegah penutupan form ketika di dalam form di klik
document.getElementById("myForm").addEventListener("click", function (event) {
    event.stopPropagation();
});

$(document).ready(function () {
    $("#sort, #category").on("change", function () {
        let sort = $("#sort").val();
        let category = $("#category").val();
        let search = $("#search").val();

        $.ajax({
            url: "/produk/search",
            type: "GET",
            data: {
                sort: sort,
                category: category,
                search: search,
            },
            success: function (data) {
                $("#container-table").html(data);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    });

    // Live search functionality
    $("#search").on("keyup", function () {
        let query = $(this).val();

        $.ajax({
            url: "/produk/search",
            type: "GET",
            data: {
                search: query,
            },
            success: function (data) {
                $("#container-table").html(data);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    });

    // Disable enter key on search input
    $("#search").on("keypress", function (e) {
        if (e.which === 13) {
            e.preventDefault();
        }
    });
});

// edit item
// document
//     .getElementById("editItemBtn")
//     .addEventListener("click", function (event) {
//         // alert("tes");
//         document.getElementById("myEditForm").style.display = "block"; // Menampilkan form
//         document.getElementById("modalOverlay").style.display = "block"; /// Menampilkan overlay
//         event.preventDefault(); // Mencegah tautan untuk mengikuti href #
//     });

// // JavaScript untuk menyembunyikan form dan overlay ketika klik di luar form atau klik tombol Cancel
// document.getElementById("modalOverlay").addEventListener("click", function () {
//     document.getElementById("myEditForm").style.display = "none";
//     document.getElementById("modalOverlay").style.display = "none";
// });

// document.getElementById("editCancelBtn").addEventListener("click", function () {
//     document.getElementById("myEditForm").style.display = "none";
//     document.getElementById("modalOverlay").style.display = "none";
// });

// // Mencegah penutupan form ketika di dalam form di klik
// document.getElementById("myEditForm").addEventListener("click", function (event) {
//     event.stopPropagation();
// });
