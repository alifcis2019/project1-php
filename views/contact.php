<?php
include_once './helper/functions.php';

$userEmail = $_SESSION['user']['email'] ?? '';
$userName = $_SESSION['user']['name'] ?? '';
?>

<div class="max-w-screen-xl mx-auto p-4 py-8">

    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="index.php" class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600">Home</a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2">Contact Us</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">Contact Us</h1>
        <p class="text-slate-500">Have questions? We would love to hear from you.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- Contact Form -->
        <div class="lg:col-span-7">
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Send Us a Message</h2>

                <form action="contact.php" method="POST">
                    <div class="grid gap-4 sm:grid-cols-2 mb-4">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-slate-900">Name <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" required
                                value="<?= htmlspecialchars($_POST['name'] ?? $userName) ?>"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Your Name">
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-slate-900">Email <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" required
                                value="<?= htmlspecialchars($_POST['email'] ?? $userEmail) ?>"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="name@example.com">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="subject" class="block mb-2 text-sm font-medium text-slate-900">Subject <span class="text-red-500">*</span></label>
                            <input type="text" id="subject" name="subject" required
                                value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="How can we help?">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="message" class="block mb-2 text-sm font-medium text-slate-900">Message <span class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="5" required
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Write your message here..."><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <button type="submit"
                        class="text-white bg-primary-600 hover:bg-primary-700 font-semibold rounded-lg text-sm px-6 py-2.5">
                        Send Message
                    </button>
                </form>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="lg:col-span-5 flex flex-col gap-6">
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Get in Touch</h3>
                <div class="space-y-4 text-sm">
                    <div>
                        <span class="block text-xs font-semibold text-slate-400 uppercase">Phone</span>
                        <p class="font-medium text-slate-900">+20 111 054 8609</p>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-slate-400 uppercase">Email</span>
                        <p class="font-medium text-slate-900">support@eraasoft.com</p>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-slate-400 uppercase">Location</span>
                        <p class="font-medium text-slate-900">Qalyubia / Cairo, Egypt</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
