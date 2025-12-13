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

---

## screenshots

admin dashboard
![dashboard ](screenshots/admin/dashboard/en.png)
![dashboard ](screenshots/admin/dashboard/ar.png)

---
categories
![categories ](screenshots/admin/categories/ar-categories.png)
![categories ](screenshots/admin/categories/en-categories.png)

---
posts
![posts ](screenshots/admin/posts/en-posts.png)
![post-create ](screenshots/admin/posts/en-posts-create.png)
![post-edit ](screenshots/admin/posts/en-posts-edit.png)

---
donation requests
![donationrequests ](screenshots/admin/requests/en-donations.png)
![donationrequest ](screenshots/admin/requests/en-donations-details.png)
![donationrequest-edit ](screenshots/admin/requests/en-donation-edit.png)

---
clients 
![clients ](screenshots/admin/clients/en-clients.png)
![clientssearch ](screenshots/admin/clients/en-clients-search.png)

---
reports 
![reports ](screenshots/admin/reports/en-reports.png)
![report-delete](screenshots/admin/reports/en-reports-delete.png)

---
roles 
![roles ](screenshots/admin/roles/en-roles.png)
![roles ](screenshots/admin/roles/en-roles-create.png)

------------------------------------------------
clients images

![home-page ](screenshots/client/en-home.png)

---
donationrequests 
![client-donations ](screenshots/client/requests/en-client-donation-requests.png)
![create-donation ](screenshots/client/requests/en-donation-create.png)
![alldonations ](screenshots/client/requests/en-donation-requests.png)

---
posts 
![posts ](screenshots/client/posts/en-posts.png)
![add-to-favorite ](screenshots/client/posts/en-post-added-to-favorites.png)
![client-favorite-posts ](screenshots/client/posts/en-posts-favorites.png)

---
notifications 
![create-notifications ](screenshots/client/notifications/en-notifications.png)
![notification-mark-as-read ](screenshots/client/notifications/en-notifications-marked-as-read.png)
![notifications ](screenshots/client/notifications/en-notifications-requests.png)

---
reports 
![create-report ](screenshots/client/reports/en-donation-request-report-create.png)
![report-created ](screenshots/client/reports/en-report-created.png)

---
profile 
![client-profile-edit ](screenshots/client/profile/en-profile-edit.png)
![change-password ](screenshots/client/profile/en-change-password.png)
![password-changed ](screenshots/client/profile/en-password-changed.png)

---
contact 
![contact-form ](screenshots/client/contact/en-contact.png)
![message-sent ](screenshots/client/contact/en-message-sent.png)
