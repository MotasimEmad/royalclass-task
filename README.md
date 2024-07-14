## Overview
Task from Royal class company

## Installation
```bash
composer install
npm install

create database royal-class then run php artisan migrate & php artisan passport:install


## User Registration
### Endpoint
- **Method:** `POST`
- **URL:** `/user_sign_up`
### Parameters
- `user_name` (string): User's name.
- `email` (string): User's email address.
- `password` (string): User's password.
- `role` (string): User's role (`admin` or `user`).
### Description
Registers a new user with the specified role.

---

## User Login
### Endpoint
- **Method:** `POST`
- **URL:** `/login`
### Parameters
- `email` (string): User's email address.
- `password` (string): User's password.
### Features
Implements throttling and single device login.

---

## Admin Features
### Manage Accounts and Content
- **Description:** Allows admins to manage user accounts and content.
### Access All Posts
- **Method:** `GET`
- **URL:** `/all_posts`
- **Authorization:** Admin role required.
### Description
Allows admins to access all posts in the system.

## Report Bad Content
### Endpoint
- **Method:** `POST`
- **URL:** `/report_content_review`
### Parameters
- `report_content` (string): Description of the reported content.
- `post_id` (uuid): ID of the post being reported.
### Description
Allows users to report content that violates community guidelines.

---

---

## Filter Bad Words
### Bad Words Array
- `['badword1', 'badword2', 'badword3']`
### Description
Filters out posts containing any of the specified bad words in titles or content.

---

## Posts
### Create Post
- **Method:** `POST`
- **URL:** `/posts`
### Description
Allows users to create new posts.

### Update Post
- **Method:** `POST`
- **URL:** `/update_post/{post_id}`
### Parameters
- `post_id` (uuid): ID of the post to update.
### Features
Users can only update or delete their own posts.

### View Posts
- **Method:** `GET`
- **URL:** `/posts`
### Description
Allows users to view all posts.

### Delete Post
- **Method:** `DELETE`
- **URL:** `/posts/{post_id}`
### Parameters
- `post_id` (uuid): ID of the post to delete.
### Features
Users can only delete their own posts.

---

## Postman Collection
Import the provided Postman collection for testing the API endpoints.
