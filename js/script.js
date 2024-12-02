// Chọn tất cả các sản phẩm trong danh sách
const productItems = document.querySelectorAll('.product_list li');

// Đường dẫn đến icon giỏ hàng
const cartIconSrc = 'https://img.pikbest.com/png-images/shopping-cart-icon---vector-template---transparent-background_1794341.png!sw800';

// Thêm icon giỏ hàng vào từng sản phẩm
productItems.forEach(item => {
    // Tạo phần tử icon giỏ hàng
    const cartIcon = document.createElement('img');
    cartIcon.src = cartIconSrc;
    cartIcon.alt = 'Thêm vào giỏ hàng';
    cartIcon.classList.add('cart-icon');

    // Thêm sự kiện click cho icon giỏ hàng
    cartIcon.addEventListener('click', function (event) {
        event.preventDefault();
        alert('Sản phẩm đã được thêm vào giỏ hàng!');
    });

    // Đặt icon giỏ hàng vào góc trên bên phải của sản phẩm
    const iconWrapper = document.createElement('a');
    iconWrapper.href = '#';
    iconWrapper.classList.add('icon');
    iconWrapper.appendChild(cartIcon);
    
    // Đặt icon giỏ hàng vào trong phần tử chứa sản phẩm
    item.appendChild(iconWrapper);
});

