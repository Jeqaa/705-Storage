function selectButton(element) {
    // Menghapus kelas 'selected' dari semua elemen
    document
        .querySelectorAll(".firstMenusTop .list-group-item")
        .forEach(function (item) {
            item.classList.remove("selected");
        });

    // Menambahkan kelas 'selected' ke elemen yang diklik
    element.classList.add("selected");
}
