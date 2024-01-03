function removeContentWrapper(page) {
    console.log(page)
    $(".app-main__inner").empty();
    $(".app-main__inner").load(page);
}