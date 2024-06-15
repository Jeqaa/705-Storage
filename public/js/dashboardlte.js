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


