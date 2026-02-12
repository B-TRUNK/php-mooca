<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>

<style>
    * {
        box-sizing: border-box;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    body {
        background: #0f172a;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card {
        background: #0b1220;
        padding: 30px;
        border-radius: 14px;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 0 40px rgba(0,0,0,0.6);
        color: white;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .field {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-size: 14px;
        color: #cbd5f5;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: none;
        outline: none;
        background: #020617;
        color: white;
        border: 1px solid #1e293b;
    }

    input:focus {
        border-color: #38bdf8;
    }

    .gender-group {
        display: flex;
        gap: 15px;
        margin-top: 6px;
    }

    .gender-group label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
    }

    button {
        width: 100%;
        padding: 12px;
        margin-top: 10px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        background: linear-gradient(135deg,#38bdf8,#6366f1);
        color: white;
        font-weight: bold;
        font-size: 15px;
        transition: 0.3s;
    }

    button:hover {
        transform: translateY(-1px);
        opacity: 0.95;
    }
</style>
</head>

<body>

<div class="card">
    <h2>Create Account</h2>

    <form method="post" action="/register" autocomplete="on">

        <div class="field">
            <label for="name">Full Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                placeholder="Enter your name"
                required
                minlength="3"
            >
        </div>

        <div class="field">
            <label for="email">Email Address</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="example@mail.com"
                required
            >
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password"
                placeholder="Min 8 characters"
                required
                minlength="8"
            >
        </div>

        <div class="field">
            <label>Gender</label>
            <div class="gender-group">
                <label>
                    <input type="radio" name="gender" value="male" required>
                    Male
                </label>
                <label>
                    <input type="radio" name="gender" value="female" required>
                    Female
                </label>
            </div>
        </div>

        <button type="submit">Register</button>

    </form>
</div>

</body>
</html>
