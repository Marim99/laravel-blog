


# Laravel Blog

Welcome to Laravel Blog, a dashboard for writing and managing blog articles. With this application, you can create new blog posts, manage comments on your posts, and update your user profile.

## Tables
Laravel Blog uses five tables to store data:

* posts: This table stores information about each blog post, including its title, description, author, slug, and image.

* comments: This table stores information about each comment on a blog post, including the comment body, author, and the ID of the post it belongs to.

* users: This table stores information about each user of the application, including their name, email address, password, slug, and image.

* profiles: This table stores additional information about each user, including their profile image and address.

* media: This table is used by the Spatie Media Library package to store uploaded media files associated with posts and user profiles.

* tags: This table stores information about tags associated with each post.

## Features

- Add new posts: Users can create new blog posts and publish them to the site (Each user has limited number of posts).

- Edit posts: Users can edit and update existing blog posts.

- Delete posts: Users can delete blog posts. Deleted posts are soft-deleted and can be restored if needed.

- View deleted posts: Users can view a list of all deleted posts.

- Force delete posts: Users can select multiple deleted posts to permanently delete.

- Restore posts: Users can restore deleted posts.

- Add comments: Users can add comments to blog posts (using livewire).

- Delete comments: Users can delete comments on blog posts.

- Search posts: Users can search for blog posts by title.

- User profile: Users can view and edit their user profile, including their name, email address, password, profile image, and address.


## API Documentation
- GET /posts: Returns a list of all blog posts.

- GET /posts/{post}: Returns a specific blog post by ID.

- POST /posts: Creates a new blog post.
 
- PATCH /posts/{post}: Updates an existing blog post.
 
- DELETE /posts/{post}: Deletes a blog post by ID.
 
- GET /posts/{post}/comments: Returns a list of comments for a - specific blog post.
 
- POST /posts/{post}/comments: Adds a new comment to a specific blog post.

- DELETE /posts/{post}/comments/{comment}: Deletes a comment from a specific blog post
## Demo video


https://user-images.githubusercontent.com/78925756/227408495-f8e6a6a3-7b3e-4902-ba8a-7f47bc9f9a94.mp4





## Deployment
  To deploy Laravel Blog, follow these steps:

1. Clone the repository to your server.

2. Run composer install to install the required dependencies.

3. Configure your environment variables by copying the .env.example file to .env and updating the values as needed.

4. Run php artisan key:generate to generate a new application key.

5. Run php artisan migrate to create the required database tables.

6. Run php artisan serve to start the development server.

7. Visit http://localhost:8000 in your web browser to view the application.
