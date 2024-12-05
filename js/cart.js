document.addEventListener("DOMContentLoaded", function() {
    const checkoutButton = document.querySelector(".checkout");

    checkoutButton.addEventListener("click", function() {
        // Redirect to the payment page
        window.location.href = "thanhtoan.php";
    });
});
