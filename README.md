# Fitness System 

The **Fitness System** is a web application designed to manage fitness subscriptions, trainee progress, and coach assignments. Built using **Laravel** (PHP framework) with **Blade templates** and **CSS**, this project follows the **MVC (Model-View-Controller)** architecture. It provides functionalities for trainees, coaches, admins, and admin moderators to interact with the system seamlessly.

---

## Features

### **Trainee Features**
- **Registration**: Trainees can register and provide personal details (weight, height, medical history, fitness goals).
- **Welcome Email & Notification**: Trainees receive a welcome email and notification after successful registration.
- **Login**: Trainees can log in using their username and password (if not blocked by an admin).
- **Package Subscription**: Trainees can view available packages (name, price, duration, features) and subscribe to one package at a time.
- **Payment Options**: Trainees can choose payment options (credit card, PayPal) to confirm their subscription.
- **Plan Notification**: Trainees receive a notification when their fitness plan is ready and can view it in the "Plans" section.
- **Health Data Management**: Trainees can update their health data, medical info, and workout progress.
- **Coach Communication**: Trainees can contact their assigned coach via WhatsApp for fitness advice.
- **Notifications**: Trainees receive notifications for:
  - Coach updates on their plans.
  - New package additions.
  - Package updates (price, discounts, descriptions).
- **Subscription Cancellation**: Trainees can cancel their subscription and receive a cancellation email and notification.
- **Help Section**: Trainees can navigate the help section for instructions.
- **Logout**: Trainees can log out to stop receiving notifications.

---

### **Coach Features**
- **Login**: Coaches can log in if their info is stored in the database and they are not blocked by an admin.
- **Profile Management**: Coaches can view and update their personal info (username, first name, last name, email, password).
- **Welcome Email**: Coaches receive a welcome email after being added by an admin.
- **Trainee Management**:
  - Receive notifications for new trainee subscriptions or cancellations in their assigned packages.
  - View and contact trainees via WhatsApp.
  - Create, update, delete, and view fitness plans for trainees.
  - Monitor trainee progress and physical state.
- **Notifications**: Coaches receive notifications if trainees update their personal info (e.g., medical history, goals).
- **Package Assignment**: Coaches receive notifications when assigned or unassigned from a package.
- **Help Section**: Coaches can navigate the help section for instructions.
- **Logout**: Coaches can log out of the system.

---

### **Admin Features**
- **Login**: Admins can log in if their info is stored in the database and they are not blocked by an admin moderator.
- **Profile Management**: Admins can view and update their personal info (username, first name, last name, email, password).
- **Payment Management**: Admins can view all trainee payments.
- **Plan Management**: Admins can view plans and their details (coach ID, assigned trainees, creation time, last update time).
- **Package Management**:
  - View, filter, and add new packages.
  - Update package info, status, and assigned coach (cannot make a package unavailable if it has active subscriptions).
- **Coach Management**:
  - View and filter coaches (blocked vs. active).
  - Add new coaches and update their salaries or block them.
- **Trainee Management**: Admins can view and update trainee info (e.g., change package, block trainee).
- **Statistics**: Admins can view system statistics (number of packages, coaches, registered trainees).
- **Notifications**: Admins receive notifications for:
  - Successful trainee registration.
  - Successful subscription or cancellation.
- **Logout**: Admins can log out of the system.

---

### **Admin Moderator Features**
- **Login**: Admin moderators can log in if their info is stored in the database.
- **Profile Management**: Admin moderators can view and update their personal info (username, first name, last name, email, password).
- **Admin Management**:
  - Add new admins to the system.
  - Update admin salaries or block admins.
- **Logout**: Admin moderators can log out of the system.

---

## Technologies Used

- **Backend**: Laravel (PHP framework)
- **Frontend**: Blade templates, CSS
- **Database**: MySQL
- **Authentication**: Laravel's built-in authentication system
- **Notifications**: Laravel Notifications (email and in-app)
- **Payment Integration**: PayPal, Credit Card (using Laravel Cashier or custom integration)
- **MVC Architecture**: Follows the Model-View-Controller pattern for clean and maintainable code.

---

## Installation

Follow these steps to set up the project locally:

### Prerequisites
- **PHP**: >= 7.4
- **Composer**: [Install Composer](https://getcomposer.org/)
- **Node.js**: For frontend dependencies (optional, if using npm for CSS)
- **Database**: MySQL, PostgreSQL, or any Laravel-supported database.

### Steps
1. Clone the repository:
   
   git clone https://github.com/hanaz12/Fitness-system.git
2. Navigate to the project directory:
   
  cd Fitness-system  
   
