console.log("AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA;");

document
    .getElementById("addItemBtn")
    .addEventListener("click", function (event) {
        // alert("tes");
        document.getElementById("myForm").style.display = "block"; // Menampilkan form
        document.getElementById("modalOverlay").style.display = "block"; // Menampilkan overlay
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

// LIVE SEARCH
// let search = document.getElementById("search");
// let tombolCari = document.getElementById("tombol-cari");
// let container = document.getElementById("container-table");

// search.addEventListener("keyup", function () {
//     // object ajax
//     let xhr = new XMLHttpRequest();

//     xhr.onreadystatechange = function () {
//         if (xhr.readyState == 4 && xhr.status == 200) {
//             container.innerHTML = xhr.responseText;
//         }
//     };

//     // xhr.open("GET", "search.php?keyword=" + search.value, true);
//     xhr.open("GET", "/produk/search?search=" + search.value, true);
//     xhr.send();
// });

// // disable tombol enter pada search
// $(document).ready(function () {
//     $("#search").on("keypress", function (e) {
//         if (e.which === 13) {
//             e.preventDefault();
//         }
//     });
// });

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
