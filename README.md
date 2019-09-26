# Blog App
> Laravel blog app.
> Note: This is a <strong>WIP</strong> Repository.

## Setup :

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
* Run DB migrations and seeders:  Type `php artisan migrate --seed` to create and populate tables. This will seed the datbase with some sample posts and a user. (User Credentials: email: *test@test.com*, password: *test@123*)
* Run `php artisan key:generate` to generate application keys.
* Run `php artisan passport:install` to setup Passport for api authentication.
* You may need to run `php artisan storage:link` to see the blog post images.
* Also do put an image file with name `noimage.jpg` inside `storage/app/public/cover_images/` directory.

## See api in action:

* Open your favorite REST client like POSTMAN or insomnia.
* `GET` request on `<localhosts_or_your_ip_address_and_port>/api/v1/allposts` to see all posts 
* `POST` request on `<localhosts_or_your_ip_address_and_port>/api/v1/login` with the following JSON body:
```
{
	"email":"test@test.com",
	"password":"test@123"
}
```
* After the login, you will obtain an `api_token` which you can use to CRUD the post from api. 
* An example is to see all the post for a user: `GET` request to `<localhosts_or_your_ip_address_and_port>/api/v1/posts` with a `Authorization` header having value `Bearer <api_token_obtained_on_loggin_in>`

#### Some screenshots of the app:

![Home page](Screenshots/Capture.PNG?raw=true)

![Login page](Screenshots/Capture2.PNG?raw=true)

![All Posts](Screenshots/AllPosts.PNG?raw=true)

![Create new Post](Screenshots/CreatePost.PNG?raw=true)

![Dashboard](Screenshots/Dashboard.PNG?raw=true)

![APIposts](Screenshots/APIposts.PNG?raw=true)

