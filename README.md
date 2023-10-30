# Product Feedback Tool

## Project Overview

Welcome to the Product Feedback Tool, a web-based application built with the Tall Stack (TailwindCSS, AlpineJS, Livewire, Laravel) to enhance communication between users and the product development team. With this tool, users can submit, view, and vote on product feedback, fostering a collaborative environment for improving the product.

## Features

### User Authentication

- **Register:** Users can create an account to access the platform.
- **Login:** Registered users can log in securely to submit feedback and vote.
- **Logout:** Users can log out to protect their account.

### Feedback Submission

- **User-Friendly Form:** A seamless form for submitting feedback with fields for title, description, and category (e.g., bug report, feature request, improvement).
- **Validation:** Ensure all required fields are filled out with validation checks.

### Feedback Listing

- **Paginated List:** Display feedback items in a paginated format for easy navigation.
- **Item Details:** Each feedback item shows its title, category, vote count, and the user who submitted it.

### Commenting System

- **User Comments:** Enable users to leave comments on feedback items.
- **Comment Details:** Comments include the user's name, date, and content.
- **Formatting Options:** Basic formatting options like bold, italic, and code blocks for comments.

### Admin Panel

- **Authentication:** Secure admin panel accessible only to authorized personnel.
- **User Management:** Admins can list & delete users to manage the platform effectively.
- **Feedback Management:** Admins can manage feedback items, enabling/disabling comments as needed.

## Bonus Features

### Advanced Commenting

- **User Mentions:** Users can mention others in comments using the "@" symbol.
- **Rich Text Editing:** Implement rich text editing options for comments, enhancing user interaction.
- **Emoji Support:** Enable emoji support in comments for expressive communication.

## User Experience (UX)

- **Responsive Design:** The tool is optimized for both desktop and mobile devices using TailwindCSS, ensuring a seamless experience.
- **Interactive UI:** AlpineJS provides interactivity, making the interface dynamic and user-friendly.
- **Real-time Updates:** Livewire enables real-time updates without compromising the user experience.

## Technologies Used

- **Frontend:** TailwindCSS, AlpineJS
- **Backend:** Laravel, Livewire
- **Database:** MySQL
- **Authentication:** Laravel Sanctum

## How to Get Started

1. Clone the repository: `https://github.com/farhanali-developer/product-feedback-tool.git`
2. Install dependencies: `composer install` and `npm install`
3. Set up your environment variables: `.env`
4. Run migrations: `php artisan migrate`
5. Start the development server: `php artisan serve`