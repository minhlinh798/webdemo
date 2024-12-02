document.addEventListener("DOMContentLoaded", () => {
    const cartButton = document.querySelector(".buttons .cart-count");
    const addToCartButtons = document.querySelectorAll(".cart-button");
    let cartItemCount = 0;

    addToCartButtons.forEach((button) => {
        button.addEventListener("click", (event) => {
            event.preventDefault();

            // Tìm hình ảnh sản phẩm
            const productImage = button.closest(".product").querySelector("img");
            const flyImage = productImage.cloneNode(true);

            // Tạo hoạt ảnh "bay"
            const rect = productImage.getBoundingClientRect();
            flyImage.classList.add("fly-to-cart");
            flyImage.style.top = rect.top + "px";
            flyImage.style.left = rect.left + "px";
            flyImage.style.width = `${productImage.offsetWidth}px`;
            flyImage.style.height = `${productImage.offsetHeight}px`;

            // Thêm ảnh vào DOM
            document.body.appendChild(flyImage);

            // Sau khi hoạt ảnh hoàn thành, xóa ảnh
            flyImage.addEventListener("animationend", () => {
                flyImage.remove();
            });

            // Tăng số lượng sản phẩm trong giỏ hàng
            cartItemCount++;
            cartButton.textContent = cartItemCount;
        });
    });
});
