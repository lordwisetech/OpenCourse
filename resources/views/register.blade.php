<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - eSchool</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>
<body class="bg-black text-white flex flex-col items-center justify-center min-h-screen">
    <div class="p-8 border border-blue-500 rounded-lg max-w-md">
        <h2 class="text-3xl font-bold mb-4">Create an Account</h2>
        <form id="registerForm">
            <input type="text" id="name" placeholder="Full Name" class="w-full p-2 mb-3 border rounded text-black" required>
            <input type="email" id="email" placeholder="Email" class="w-full p-2 mb-3 border rounded text-black" required>
            <input type="password" id="password" placeholder="Password" class="w-full p-2 mb-3 border rounded text-black" required>
            <input type="password" id="password_confirmation" placeholder="Confirm Password" class="w-full p-2 mb-3 border rounded text-black" required>
            <p class="text-sm text-gray-400 mb-4">By creating an account, you agree to our <a href="#" class="text-blue-500">Terms of Service</a> and <a href="#" class="text-blue-500">Privacy Policy</a>.</p>
            <p class="text-sm text-gray-400 mb-4">Already have an account? <a href="/login" class="text-blue-500">Login</a></p>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg w-full">Register</button>
        </form>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast">Registration successful!</div>

    <script>
        document.getElementById("registerForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let password_confirmation = document.getElementById("password_confirmation").value;

    axios.post("/register", {
        name: name,
        email: email,
        password: password,
        password_confirmation: password_confirmation // Add this field
    })
    .then(response => {
        let toast = document.getElementById("toast");
        toast.style.display = "block";
        setTimeout(() => {
            toast.style.display = "none";
            window.location.href = "/login"; // Redirect to login page
        }, 3000);
    })
    .catch(error => {
        alert("Error: " + error.response.data.message);
    });
});

    </script>
</body>
</html>
