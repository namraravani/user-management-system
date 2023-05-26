<!DOCTYPE html>
<html>
<head>
  <title>Contact Us</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
    }
    .container {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .container h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .container input[type="text"],
    .container textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: none;
    }
    .container textarea {
      height: 150px;
    }
    .container input[type="submit"] {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 4px;
      background-color: #4CAF50;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }
    .container input[type="submit"]:hover {
      background-color: #45a049;
    }
    .container p.success-message {
      color: green;
      font-weight: bold;
      margin-top: 10px;
      text-align: center;
      display: none; /* Hide the message by default */
    }
  </style>
  <script>
    window.addEventListener("DOMContentLoaded", function () {
      var form = document.querySelector("form");
      var successMessage = document.querySelector(".success-message");

      form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the form from submitting

        // Display the success message
        successMessage.style.display = "block";
        form.reset(); // Reset the form fields
      });
    });
  </script>
</head>
<body>
  <div class="container">
    <h2>Contact Us</h2>
    <form action="#" method="post">
      <input type="text" name="name" placeholder="Your Name" required>
      <input type="text" name="email" placeholder="Your Email" required>
      <textarea name="message" placeholder="Your Message" required></textarea>
      <input type="submit" value="Send Message">
    </form>
    <p class="success-message">Thank you for contacting us.</p>
  </div>
</body>
</html>
