function removeContentWrapper(page) {
    console.log(page);
    $(".app-main__inner").empty();
    $(".app-main__inner").load(page, function () {
        // Adjust z-index values
        $('.modal-backdrop.show').css("z-index", "0");
        $('.modal.show').css("z-index", "1");
    });
}

function toDestination(page) {
    window.open(page, '_blank');
}
$(document).ready(function () {
    $('.edit').on('click', function () {
        console.log("ADJUSTED!!");
        $('.modal-backdrop').css("z-index", "0");
        $('.modal.show').css("z-index", "1");
    })
});

document.querySelector('.edit').click()