# Blog App
> Laravel blog app.
> Note: This is a <strong>WIP</strong> Repository.

## To test:

* Type `git clone https://github.com/pfieffer/LaravelBlogApp.git` or `git clone git@github.com:pfieffer/LaravelBlogApp.git` to clone the repository.
* CD to `LaravelBlogApp`
* Type `composer install`
* Type `composer update`
* Copy *.env.example* to *.env*
* To use MySQL database, set the following in *.env* file :
   * set DB_CONNECTION
   * set DB_DATABASE
   * set DB_USERNAME
   * set DB_PASSWORD
* Run DB migrations. Type `php artisan migrate --seed` to create and populate tables.
* Run `php artisan key:generate` to generate application keys
* You may need to run `php artisan storage:link` to see the blog post images.
* Also do put an image file with name `noimage.jpg` inside `storage/app/public/cover_images/` directory.

#### Some screenshots of the app:

![Home page](Screenshots/Capture.PNG?raw=true)

![Login page](Screenshots/Capture2.PNG?raw=true)

![All Posts](Screenshots/AllPosts.PNG?raw=true)

![Create new Post](Screenshots/CreatePost.PNG?raw=true)

![Dashboard](Screenshots/Dashboard.PNG?raw=true)

![APIposts](Screenshots/APIposts.PNG?raw=true)

