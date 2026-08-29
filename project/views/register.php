<!-- Registration Form Area -->
<div class="flex items-center justify-center min-h-screen p-12 px-4 bg-gray-50">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-900">Create an Account</h2>
            <form action="register.php" method="POST">

                <!-- Email Field -->
                <div class="mb-5">
                    <label for="email" class="block mb-2.5 text-sm font-medium text-gray-900">Your email</label>
                    <input type="email" id="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5 shadow-sm placeholder-gray-400"
                        placeholder="name@company.com" required />
                </div>

                <!-- Password Field -->
                <div class="mb-5">
                    <label for="password" class="block mb-2.5 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5 shadow-sm placeholder-gray-400"
                        placeholder="••••••••" required />
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-5">
                    <label for="confirm_password" class="block mb-2.5 text-sm font-medium text-gray-900">Confirm
                        password</label>
                    <input type="password" id="confirm_password" name="confirm_password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5 shadow-sm placeholder-gray-400"
                        placeholder="••••••••" required />
                </div>

                <!-- Terms Checkbox -->
                <label for="terms" class="flex items-start mb-5 cursor-pointer">
                    <div class="flex items-center h-5">
                        <input id="terms" name="terms" type="checkbox"
                            class="w-4 h-4 border border-gray-300 rounded bg-white text-blue-600 focus:ring-2 focus:ring-blue-200 cursor-pointer"
                            required />
                    </div>
                    <span class="ms-2 text-sm font-medium text-gray-900 select-none">I agree with the <a href="#"
                            class="text-blue-600 hover:underline">terms and conditions</a></span>
                </label>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full text-white bg-blue-600 box-border border border-transparent hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 shadow-sm font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none transition-colors duration-200">
                    Register new account
                </button>

                <!-- Login Link -->
                <div class="text-sm font-medium text-gray-500 text-center mt-5">
                    Already have an account? <a href="login.php" class="text-blue-600 hover:underline">Login here</a>
                </div>
            </form>
        </div>
    </div>
</div>