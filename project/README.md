# 🛍️ EraaSoft PMS — Modern E-Commerce Platform & Design System

[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![Flowbite](https://img.shields.io/badge/Flowbite-2.3-1C64F2?style=for-the-badge&logo=flowbite&logoColor=white)](https://flowbite.com/)
[![FontAwesome](https://img.shields.io/badge/Font_Awesome-6.5-528DD7?style=for-the-badge&logo=font-awesome&logoColor=white)](https://fontawesome.com/)
[![Responsive](https://img.shields.io/badge/Responsive-100%25_Mobile--First-10B981?style=for-the-badge)](https://developer.mozilla.org/en-US/docs/Learn/CSS/CSS_layout/Responsive_Design)
[![License: MIT](https://img.shields.io/badge/License-MIT-F59E0B?style=for-the-badge)](LICENSE)

A modern, high-performance E-Commerce platform and Product Management System (PMS) crafted with **Pure PHP 8**, a custom **Tailwind CSS Design System**, **Flowbite UI Primitives**, and a lightweight **JSON Flat-File Database**.

Engineered with a **component-driven frontend architecture**, intuitive micro-interactions, responsive mobile-first layouts, role-based access control (RBAC), and persistent shopping cart synchronization.

---

## 🎨 Frontend Architecture & Design System

The application is built on a custom design system prioritizing visual hierarchy, accessible contrast ratios, and tactile micro-interactions.

```
┌────────────────────────────────────────────────────────────────────────┐
│                        PRESENTATION LAYER (UI)                         │
├───────────────────┬─────────────────────┬──────────────────────────────┤
│  DESIGN TOKENS    │  ATOMIC COMPONENTS  │  INTERACTIVE VIEWS           │
│  • Plus Jakarta   │  • Sticky Navbar    │  • Hero & Product Grid       │
│  • Indigo/Blue    │  • Cart Drawer      │  • Multi-angle Gallery       │
│  • Slate Neutrals │  • Toast System     │  • Tabbed User Dashboard     │
│  • Micro-shadows  │  • Quantity Step    │  • Two-Column Checkout Form  │
└───────────────────┴─────────────────────┴──────────────────────────────┘
```

### 1. 🌈 Design Tokens & Styling Guide
- **Typography**: Clean, modern typography using Google's **Plus Jakarta Sans** (`300` to `800` weights) with custom letter-spacing and optimized line heights for high scannability.
- **Color Palette**:
  - **Primary**: Dynamic Royal Blue spectrum (`#eff6ff` through `#172554`), with `#2563eb` (Blue-600) for primary actions and `#1d4ed8` (Blue-700) for hover/active states.
  - **Neutrals**: Crisp `slate-50` body backgrounds paired with `slate-800` text for optimal contrast without harsh eye strain.
  - **Semantic States**: Emerald (`green-500`) for in-stock badges and success toasts, Crimson (`red-500`) for out-of-stock and error alerts, and Amber (`amber-500`) for admin control notices.
- **Micro-Animations**:
  - Image hover zoom (`group-hover:scale-105 transition-transform duration-300`) on product cards.
  - Spring-loaded slide-in and fade effects for toast alerts and cart drawers.
  - Interactive active/selected state styling on category pills, color swatches, and size selectors.

### 2. 🧩 Reusable Component Architecture (`inc/`)
- **Sticky Smart Navbar (`inc/navbar.php`)**:
  - Fixed-top header with backdrop blur and responsive layout.
  - Live shopping cart badge indicator showing dynamic item counts.
  - Authenticated user avatar dropdown with role pill indicators (`Admin` vs `Customer`).
  - Mobile hamburger collapse menu powered by Flowbite data attributes.
- **Slide-Over Cart Drawer (`inc/carts.php`)**:
  - Off-canvas sidebar component featuring an overlay backdrop.
  - Real-time product thumbnails, pricing calculation, quantity modifiers, and one-click remove action.
  - Contextual empty state illustration when the cart has no items.
- **Dynamic Flash Toast Notification System (`inc/toaster.php`)**:
  - Non-intrusive floating toast notifications with distinct semantic color badges, SVGs, and dismissal triggers.
  - Automatically renders flash notifications upon redirects (login success, item added to cart, profile updated, checkout completed).
- **Interactive Modals & Dropdowns (`inc/header.php` & `inc/footer.php`)**:
  - Accessible Flowbite data-attributes (`data-drawer-target`, `data-collapse-toggle`, `data-tabs-toggle`) providing fluid client-side interaction without heavy JavaScript framework overhead.

---

## ✨ Key Features & User Journeys

### 🛍️ Storefront & Merchandising
- **Modern Homepage (`index.php` / `views/home.php`)**:
  - High-impact hero section with primary call-to-actions.
  - Popular category discovery grid with responsive hover states.
  - Featured products grid with discount badges, price strikethroughs, and star ratings.
  - Value proposition section highlighting free shipping, 30-day money-back guarantee, and 24/7 customer support.
- **Interactive Product Catalog (`products.php` / `views/products.php`)**:
  - 4-column responsive grid transitioning smoothly to 1-column on mobile viewports.
  - Sale badges, out-of-stock overlays, and direct detail links.
- **Product Details Showcase (`product.php` / `views/product.php`)**:
  - Multi-image gallery with thumbnail preview selectors.
  - Real-time stock status badge (`In Stock` vs `Out of Stock`).
  - Interactive quantity stepper (`+` / `-`) preventing negative/zero selections.
  - Dynamic option selectors for product colors and sizes.
  - "Customers Also Bought" recommendation carousel.

### 🛒 Cart & Checkout Experience
- **Session & Flat-File Cart Synchronization**:
  - Seamless guest-to-authenticated cart merging upon login.
  - User-isolated persistent storage in `database/carts.json`.
- **Frictionless Checkout Flow (`checkout.php` / `views/checkout.php`)**:
  - Responsive two-column checkout layout: Customer & Shipping Details on the left, Dynamic Order Summary on the right.
  - Auto-fills registered user profile details (Name, Email, Phone, Address, City).
  - Selectable payment method cards (Cash on Delivery vs Credit/Debit Card).
  - Real-time breakdown of subtotal, flat shipping rates, and grand total.
  - Post-checkout automated order generation (`ORD_...`) and cart reset.

### 👤 Customer Portal & Order Center (`profile.php` / `views/profile.php`)
- **Tabbed Dashboard**:
  - **Profile Information**: Update customer name, phone number, shipping address, and city.
  - **Order History**: Track past orders with unique order reference codes, date stamps, line items, and status badges (`Processing`, `Delivered`).
  - **Security & Password**: Secure password update form requiring confirmation of existing credentials.
  - **Spending Metrics**: Real-time spending overview cards calculating lifetime total orders and total monetary investment.
  - **Admin Inbox**: Dedicated tab for administrators to review customer contact messages.

### ⚡ Admin Product Studio (CRUD & RBAC)
- **Role-Based Guards**: Protected endpoints (`create-product.php`, `edit-product.php`, `actions/delete-product.php`) restricted via `is_admin()` middleware.
- **Product Creator & Editor (`views/create-product.php`, `views/edit-product.php`)**:
  - Multi-file image upload dropzone with preview.
  - Fields for Title, Category, Current Price, Original/Sale Price, Stock Status, and Description.
  - Immediate catalog synchronization across all views.

---

## 🏗️ Folder Structure & Architecture

```plaintext
project-root/
│
├── actions/                  # Controller action handlers (POST processing)
│   ├── add-new-product.php   # Handles product creation & multi-image upload
│   ├── edit-product.php      # Handles product data updates
│   ├── delete-product.php    # Handles product deletion & asset cleanup
│   ├── add-to-cart.php       # Handles cart insertion & quantity increment
│   └── remove-from-cart.php  # Handles cart item removal
│
├── database/                 # JSON flat-file storage engine
│   ├── users.json            # User accounts, hashed passwords, roles & addresses
│   ├── products.json         # Base catalog entries (ID, name, price, thumbnail)
│   ├── product_details.json  # Extended details (galleries, stock, categories, options)
│   ├── carts.json            # Persistent user cart dictionaries
│   ├── orders.json           # Order records, line items & shipping metadata
│   └── messages.json         # Contact form customer inquiries
│
├── helper/
│   └── functions.php         # Core business logic, auth guards, cart helpers & JSON drivers
│
├── inc/                      # Shared atomic layout components
│   ├── header.php            # HTML5 head, Tailwind config, Google Fonts & metadata
│   ├── navbar.php            # Sticky navigation bar, user dropdown & cart trigger
│   ├── carts.php             # Off-canvas slide-over cart drawer component
│   ├── toaster.php           # Dynamic multi-state flash message alert component
│   ├── footer.php            # Global footer with brand links & payment badges
│   └── script.php            # Flowbite client scripts
│
├── uploads/                  # Uploaded product imagery
│
├── views/                    # Presentation templates (Clean separation of concerns)
│   ├── home.php              # Storefront landing page view
│   ├── products.php          # Product catalog grid view
│   ├── product.php           # Single product detail view
│   ├── create-product.php    # Product creation form view (Admin)
│   ├── edit-product.php      # Product modification form view (Admin)
│   ├── checkout.php          # Two-column checkout & order summary view
│   ├── profile.php           # Tabbed customer dashboard & order history view
│   ├── login.php             # Authentication sign-in view
│   ├── register.php          # Account creation view
│   ├── about.php             # Brand mission & company story view
│   ├── contact.php           # Interactive contact form view
│   └── 404.php               # Custom branded 404 error view
│
├── index.php                 # Storefront entry point
├── products.php              # Catalog page controller
├── product.php               # Product details controller
├── create-product.php        # Admin create product route
├── edit-product.php          # Admin edit product route
├── checkout.php              # Checkout processing route
├── profile.php               # Customer portal route
├── login.php                 # Login route
├── register.php              # Registration route
├── logout.php                # Session destruction & logout route
├── about.php                 # About Us page route
├── contact.php               # Contact Us page route
└── 404.php                   # Error handling fallback
```

---

## 🛠️ Technology Stack & Dependencies

| Layer | Technology | Version / Source | Purpose |
| :--- | :--- | :--- | :--- |
| **Backend Runtime** | PHP | `8.0+` | Server-side logic, routing, JSON flat-file storage, session auth |
| **Styling Engine** | Tailwind CSS | `3.x (CDN)` | Utility-first styling, responsive breakpoints, custom theme tokens |
| **UI Components** | Flowbite | `2.3.0` | Accessible drawers, dropdowns, tabs, and interactive modals |
| **Typography** | Plus Jakarta Sans | Google Fonts | Primary font family for modern aesthetic and legibility |
| **Iconography** | Font Awesome | `6.5.1` | Vector icon system for badges, actions, and social links |
| **Database** | JSON Flat Files | Native Filesystem | Zero-dependency file-based data persistence with PHP serialization |
| **Security** | BCRYPT / XSS Shield | `password_hash()` / `htmlspecialchars()` | Secure password hashing, credential verification, and input sanitation |

---

## 🚀 Getting Started & Local Development

### 📋 Prerequisites
- **PHP** `>= 8.0` installed on your development machine.
- A modern web browser (Chrome, Firefox, Safari, Edge).

### ⚙️ Installation & Running

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-username/eraasoft-pms-ecommerce.git
   cd eraasoft-pms-ecommerce
   ```

2. **Launch the PHP Development Server**:
   ```bash
   php -S localhost:3000
   ```

3. **Open the Application**:
   Visit [http://localhost:3000](http://localhost:3000) in your browser.

---

## 👥 Demo Accounts

Use the following pre-configured credentials to test different user roles and permission levels:

| Role | Email | Password | Permissions & Capabilities |
| :--- | :--- | :--- | :--- |
| 🛡️ **Administrator** | `admin@admin.com` | `admin123` | Full access: Add/Edit/Delete products, manage catalog, view customer inquiries |
| 🛍️ **Customer** | `user@user.com` | `user123` | Shopping cart, checkout, profile updates, order history & tracking |

> [!TIP]
> You can also register a brand new customer account at any time via the [Register Page](http://localhost:3000/register.php).

---

## 📱 Responsive Breakpoints & Accessibility

The user interface follows mobile-first responsive design principles:

- **Mobile (`< 640px`)**: Full-width single-column layouts, touch-friendly hit areas (`min 44px`), collapsible navigation drawer.
- **Tablet (`640px - 1024px`)**: 2-to-3 column grids, optimized typography scales, responsive modals.
- **Desktop (`1024px+`)**: 4-column product grids, multi-column checkout, sticky navigation with instant search & cart flyout.
- **Accessibility (a11y)**:
  - Standard HTML5 semantic elements (`<nav>`, `<main>`, `<section>`, `<article>`, `<header>`, `<footer>`).
  - Screen-reader labels (`aria-label`, `aria-hidden`, `aria-labelledby`, `role="alert"`).
  - Clear keyboard focus indicators on interactive inputs and buttons.

---

## 📄 License
This project is open-source software licensed under the [MIT License](LICENSE).
