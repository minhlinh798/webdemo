

document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    
    // Giả sử kiểm tra tên đăng nhập và mật khẩu thành công
    if (username === "user" && password === "password") {
        // Đánh dấu là đã đăng nhập
        localStorage.setItem("isLoggedIn", "true");
        
        // Chuyển hướng về trang chủ
        window.location.href = "index.html";
    } else {
        alert("Tên đăng nhập hoặc mật khẩu không đúng!");
    }
});
