<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - eSchool</title>
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
        <h2 class="text-3xl font-bold mb-4">Login</h2>
        <form id="loginForm">
            <input type="email" id="email" placeholder="Email" class="w-full p-2 mb-3 border rounded text-black" required>
            <input type="password" id="password" placeholder="Password" class="w-full p-2 mb-3 border rounded text-black" required>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg w-full">Login</button>
        </form>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast">Login successful!</div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault();

            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;

            axios.post("/login", {
                email: email,
                password: password
            })
            .then(response => {
                let toast = document.getElementById("toast");
                toast.style.display = "block";
                setTimeout(() => {
                    toast.style.display = "none";
                    window.location.href = "/dashboard"; // Redirect after login
                }, 2000);
            })
            .catch(error => {
                alert("Error: " + error.response.data.message);
            });
        });
    </script>
</body>
</html>
