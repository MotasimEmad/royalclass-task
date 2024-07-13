# royalclass-task

## Overview
Api project - task from Royal class

## Installation
1. **Clone the repository:**
   ```bash
   git clone <[repository-url](https://github.com/MotasimEmad/royalclass-task.git)>
   cd project-directory

composer install
npm install # if using npm for frontend dependencies

php artisan migrate

User Registration:

Endpoint: POST /sign_up_user
Parameters: user_name, email, password, role (admin or user)
User Login:

Endpoint: POST /login
Parameters: email, password
Features: Implements throttling and single device login.
Admin Features:

Manage accounts and content.
Access all posts using GET /all_posts (admin role only).
Filter Bad Words:

Bad words array: ['badword1', 'badword2', 'badword3']
Error returned if title or content contains bad words.
Report Bad Content:

Endpoint: POST /report_content_review
Parameters: report_content, post_id
Posts:

Create post: POST /create_post
Update post: PUT /post_update/{post_id}
Features: Users can only update or delete their own posts.
Postman Collection
Import the provided Postman collection for testing the API endpoints.
