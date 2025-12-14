# Donation Requests Management System

## Overview

**Donation Requests Management System** is a Laravel-based web application designed to manage blood and general donation requests.

The system provides an **Admin Dashboard**, a **Client Interface**, and a **RESTful API**, with a notification system based on **Firebase Cloud Messaging (FCM)** and database storage.

---

## Key Features

### Admin Dashboard
- View and manage all registered clients
- Block / unblock clients
- View and manage donation requests
- Review and manage **reports** submitted by clients
- Create and manage posts
- Manage user roles and permissions using **Spatie Laravel Permission**
- Receive and manage client messages

---

### Client Features

- Create donation requests
- Receive notifications for donation requests that match their **blood type**
- Report incorrect or fake donation requests
- Browse categories and posts
- Add posts to **favorites**
- Manage personal profile information

---

## Notification System
- Push notifications for mobile/API via **Firebase Cloud Messaging (FCM)**
- Database-stored notifications for website users
- Notifications delivered based on blood type and city

---

## API
- RESTful API for:
  - Donation requests
  - Categories
  - Posts
  - Users
- Designed to support **mobile applications**

---

## Permissions & Translations
- **Spatie Laravel Permission**  
  Role-based access control for admins.
  
- **Spatie Laravel Translatable**  
  Multi-language support for database content (categories).

---

## Tech Stack
- **Backend:** Laravel (PHP)
- **Frontend:** Blade
- **Database:** MySQL
- **Notifications:** Firebase Cloud Messaging (FCM)
- **API Authentication:** Token-based authentication

---

## Packages Used
- `spatie/laravel-permission`
- `spatie/laravel-translatable`
- Firebase Cloud Messaging (FCM)

---

## Installation
### 1. Install Dependencies
composer install
npm install
npm run 
