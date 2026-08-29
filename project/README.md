# 🛍️ EraaSoft PMS — Modern E-Commerce Platform

A feature-rich, lightweight, and modern E-Commerce web application and Product Management System (PMS) built with **Pure PHP**, **Tailwind CSS**, **Flowbite**, and a **JSON Flat-File Database**.

Designed with clean architecture, procedural fundamentals, full CRUD operations, role-based access control, persistent multi-user cart synchronization, and a sleek responsive UI.

---

## ✨ Features Overview

### 🔐 1. Authentication & Role-Based Access Control
- **User Registration**: Secure account creation with email validation and password hashing (`password_hash` with `PASSWORD_DEFAULT`).
- **User Login**: Session-based login with flash message notifications and role assignment (`admin` vs `user`).
- **User Profile Management**:
  - Update personal information (Full Name, Phone, Shipping Address, City).
  - Change Password with verification of current password and length validation.
  - View real-time personal Order History and total spending stats.
- **Admin Protection**: Restricted pages (`create-product.php`, `edit-product.php`, `delete-product.php`) guarded by `is_admin()` middleware.

### 📦 2. Full Product Management (CRUD)
- **Create**: Admins can add products with title, category, description, pricing, original price (discount/sale badge), stock status, and multiple gallery images (`uploads/`).
- **Read**:
  - **Catalog Page (`products.php`)**: Responsive grid with sale badges, star ratings, and stock status indicators.
  - **Product Details (`product.php`)**: Full product page with interactive image gallery, stock badge, quantity selector (`+` / `-`), and related recommendations.
- **Update**: Admins can edit any product with prefilled data and optional image replacement.
- **Delete**: Admins can remove products with automatic cleanup from catalogs, details, and user carts.

### 🛒 3. Smart Shopping Cart System
- **Guest to User Cart Merging**: Items added by a guest in session are automatically merged with the user's saved account cart upon login.
- **Multi-User Isolation & Persistence**: Cart data is saved per user in `database/carts.json`, ensuring different users on the same machine never see each other's items.
- **Stock Validation**: Products marked as `Out of Stock` are disabled both in the UI and blocked in the backend.
- **Cart Drawer**: Fast slide-out cart sidebar with live quantity updates, item totals, subtotal calculations, and one-click remove.

### 💳 4. Checkout & Order Processing
- **Responsive Checkout Form**: Collects customer information, shipping address, delivery notes, and payment method (Cash on Delivery or Credit/Debit card).
- **Order Tracking**: Generates unique Order IDs (`ORD_...`), records items, calculates shipping and totals, and saves orders to `database/orders.json`.
- **Post-Checkout Auto-Clear**: Automatically empties the session cart and resets the user's saved database cart.

### 🌐 5. Modern Pages
- **Homepage (`index.php`)**: Hero section, popular categories, featured products, and company highlights.
- **About Us (`about.php`)**: Brand mission, core values, and delivery guarantees.
- **Contact Us (`contact.php`)**: Interactive contact form storing customer inquiries into `database/messages.json`.

---

## 🏗️ Project Architecture

```plaintext
project-root/
│
├── actions/                  # Backend processing scripts (Actions)
│   ├── add-new-product.php   # Handle product creation & uploads
│   ├── edit-product.php      # Handle product updates
│   ├── delete-product.php    # Handle product deletion
│   ├── add-to-cart.php       # Add/update cart items with quantity & stock check
│   └── remove-from-cart.php  # Remove items from cart
│
├── database/                 # JSON flat-file storage
│   ├── users.json            # Registered user accounts & roles
│   ├── products.json         # Base product catalog
│   ├── product_details.json  # Extended details, gallery & stock
│   ├── carts.json            # Persistent user carts
│   ├── orders.json           # Placed customer orders
│   └── messages.json         # Contact form messages
│
├── helper/
│   └── functions.php         # Core helpers (Auth, Flash messages, Cart & JSON loaders)
│
├── inc/                      # Shared layout components
│   ├── header.php            # HTML <head>, Tailwind & Flowbite CSS, Navbar
│   ├── navbar.php            # Dynamic navigation bar & user dropdown
│   ├── carts.php             # Slide-over Cart Drawer component
│   └── footer.php            # Footer scripts & copyright
│
├── uploads/                  # Uploaded product images
│
├── views/                    # UI template views
│   ├── home.php              # Homepage view
│   ├── products.php          # Products listing view
│   ├── product.php           # Single product detail view
│   ├── create-product.php    # Create product form view
│   ├── edit-product.php      # Edit product form view
│   ├── checkout.php          # Checkout form & order summary view
│   ├── profile.php           # User profile & order history view
│   ├── login.php             # Login view
│   ├── register.php          # Registration view
│   ├── about.php             # About Us view
│   └── contact.php           # Contact Us view
│
├── index.php                 # Homepage controller
├── products.php              # Products page controller
├── product.php               # Product details controller
├── create-product.php        # Create product controller (Admin)
├── edit-product.php          # Edit product controller (Admin)
├── checkout.php              # Checkout controller
├── profile.php               # Profile controller
├── login.php                 # Login controller
├── register.php              # Register controller
├── logout.php                # Logout handler
├── about.php                 # About Us controller
└── contact.php               # Contact Us controller
```

---

## 🚀 Getting Started

### 📋 Prerequisites
- **PHP** >= 8.0 installed on your machine.
- Web browser (Chrome, Firefox, Edge, Safari).

### ⚙️ Installation & Running Locally

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-username/eraasoft-pms-ecommerce.git
   cd eraasoft-pms-ecommerce
   ```

2. **Start the PHP Built-in Server**:
   ```bash
   php -S localhost:3000
   ```

3. **Open the Application**:
   Navigate to [http://localhost:3000](http://localhost:3000) in your web browser.

---

## 👤 Demo Accounts

| Role | Email | Password | Permissions |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@admin.com` | `admin123` | Full Access (Create, Edit, Delete Products, Manage Orders) |
| **Customer** | `user@user.com` | `user123` | Shopping, Add to Cart, Checkout, Order History, Profile |

*(You can also register a new customer account anytime via the [Register page](http://localhost:3000/register.php)).*

---

## 🛠️ Technologies Used

- **Backend**: Pure PHP 8 (Procedural & Clean Architecture)
- **Database**: JSON Flat Files (`file_get_contents`, `file_put_contents`, `json_encode`, `json_decode`)
- **Frontend & Styling**: Tailwind CSS, Flowbite UI Components, FontAwesome 6 Icons
- **Security**:
  - Input sanitation via `htmlspecialchars()` & `trim()`.
  - Passwords securely hashed with `password_hash()` and verified with `password_verify()`.
  - Access Control Lists (ACL) on Admin actions and endpoints.

---

## 📄 License
This project is open source and available under the [MIT License](LICENSE).
