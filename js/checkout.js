function toggleExtraFields() {
    const method = document.getElementById('method').value;
    const cardFields = document.getElementById('cardFields');
    const phoneField = document.getElementById('phoneField');

    // Hiển thị các trường thông tin bổ sung dựa trên phương thức thanh toán
    if (method === 'card' || method === 'transfer') {
      cardFields.style.display = 'block';
      phoneField.style.display = 'none';
    } else if (method === 'wallet') {
      cardFields.style.display = 'none';
      phoneField.style.display = 'block';
    } else {
      cardFields.style.display = 'none';
      phoneField.style.display = 'none';
    }
  }
  
  document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector(".payment-form form");

    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the form from submitting the default way

        // Get form data (optional if you want to use it later)
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const amount = document.getElementById("amount").value;
        const method = document.getElementById("method").value;

        // Perform any additional validation or processing here if needed

        // Redirect to payment confirmation page
        window.location.href = "qldh.php";
    });
});
