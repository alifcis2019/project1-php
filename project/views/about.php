<?php
include_once './helper/functions.php';
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
                    <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2">About Us</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header Banner -->
    <div class="bg-gradient-to-r from-primary-600 to-blue-700 rounded-2xl p-8 md:p-12 mb-12 text-white shadow-lg">
        <h1 class="text-3xl sm:text-4xl font-extrabold mb-4">About EraaSoft PMS</h1>
        <p class="text-primary-100 text-base max-w-2xl leading-relaxed mb-6">
            We are dedicated to providing a simple, reliable, and delightful e-commerce platform offering top-quality products with fast delivery.
        </p>
        <a href="products.php" class="inline-flex items-center px-5 py-2.5 text-sm font-bold text-primary-700 bg-white rounded-lg hover:bg-slate-50">
            Browse Products
        </a>
    </div>

    <!-- Features Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm text-center">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-primary-600 flex items-center justify-center mx-auto mb-4 text-xl">
                <i class="fa-solid fa-award"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900 mb-2">Quality Products</h3>
            <p class="text-sm text-slate-500">We inspect and curate only high-quality items for our customers.</p>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm text-center">
            <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center mx-auto mb-4 text-xl">
                <i class="fa-solid fa-truck-fast"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900 mb-2">Fast Delivery</h3>
            <p class="text-sm text-slate-500">Quick processing and direct doorstep delivery across Egypt.</p>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm text-center">
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mx-auto mb-4 text-xl">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900 mb-2">Secure Shopping</h3>
            <p class="text-sm text-slate-500">Safe payments and Cash on Delivery guarantee total peace of mind.</p>
        </div>
    </div>

</div>
