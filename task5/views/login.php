<!-- Light mode only login page -->
<div class="flex items-center justify-center min-h-screen p-12 bg-gray-50">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-900">Login</h2>
            <form action="login.php" method="POST">
                <div class="mb-5">
                    <label for="email" class="block mb-2.5 text-sm font-medium text-gray-900">Your email</label>
                    <input type="email" id="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5 shadow-sm placeholder-gray-400"
                        placeholder="name@company.com" required />
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-2.5 text-sm font-medium text-gray-900">Your password</label>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5 shadow-sm placeholder-gray-400"
                        placeholder="••••••••" required />
                </div>

                <label for="remember" class="flex items-center mb-5 cursor-pointer">
                    <input id="remember" name="remember" type="checkbox"
                        class="w-4 h-4 border border-gray-300 rounded bg-white text-blue-600 focus:ring-2 focus:ring-blue-200 cursor-pointer" />
                    <span class="ms-2 text-sm font-medium text-gray-900 select-none">Remember me</span>
                </label>

                <button type="submit"
                    class="w-full text-white bg-blue-600 box-border border border-transparent hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 shadow-sm font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none transition-colors duration-200">
                    Login
                </button>

                <!-- Registration Link Added Here -->
                <div class="text-sm font-medium text-gray-500 text-center mt-5">
                    Don't have an account? <a href="register.php" class="text-blue-600 hover:underline">Register
                        here</a>
                </div>
            </form>
        </div>
    </div>
</div>