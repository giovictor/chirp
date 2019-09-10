# Chirp

A cooler and simplified version of Twitter made using Laravel and Vue.js with :heart:

## Getting Started

Start CMD and cd into your chosen directory or much better if you have XAMPP installed and it is in the htdocs folder

Clone this repository in your machine

```
git clone https://github.com/giovictor/chirp.git
```

Create the vendor directory and install the Composer Packages including Laravel

```
composer install
```

Create the node_modules directory and install all NPM Packages including Vue.js

```
npm install
```

Start the server either on XAMPP htdocs folder (localhost/[directory_name]/public) or using

```
php artisan serve
```

To compile any JavaScript or Sass changes run 

```
npm run dev 
//or
npm run watch
```

You can create your own account on the site or use my demo credentials

```
email: giorodriguez021@gmail.com
password: secret
````

## Features

1. Users can view chirps (posts) by other users on the homepage feed.
2. Users can post chirps with a maximum character limit of 200 and can delete their own posts in the feed or in their own profile page.
3. Users can also view other people's profile and can see their chirps.