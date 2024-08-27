<p align="center"><a href="https://cercle-myco-bruxelles.be" target="_blank"><img src="./public/assets/common/img/icon.png" alt="CMB Logo" style="max-height: 300px"></a></p>

# Website of *Cercle de Mycologie de Bruxelles*

This repository contains the backend code for the "*Cercle de Mycologie de Bruxelles*". The online version is available at [https://cercle-myco-bruxelles.be](https://cercle-myco-bruxelles.be).

## Backend

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

This project uses the php framework Laravel.

### Requirements

- PHP 8.2 or Higher
- Composer

### Todo after cloning the repository

#### 1 - Create the .env file

A **_.env_** file is used to configurate the environment of the application, you can use the [.env.example](./.env.example) to help you.

See the section [The .env file](#the-env-file) for details about custom properties.

##### 1.1 - Generate an app key

Use the following command to generate an encryption key:

```shell
php artisan key:generate
```

#### 2 - Migrate the database

Use the following command to migrate the database:

```shell
php artisan migrate  
```

For informations about what is a migration, [see this link](https://laravel.com/docs/11.x/migrations#introduction).

### Serve

You can run a dev server by using the command:

```shell
php artisan serve
```

If it doesn't work, try:

```shell
php -S 127.0.0.1:8000 -t public
```

## The .env file

> The *.env* file is used in projects to store configuration settings, environment variables, and sensitive information securely. It provides a convenient way to manage and organize various parameters that your project needs without hard-coding them directly into your code.
>
>[Sujatha Mudadla - medium.com](https://medium.com/@sujathamudadla1213/what-is-the-use-of-env-8d6b3eb94843)

An example of the .env file is provided in the directory. This is the [.env.example](.env.example) file.

Find below the description of property used for the CMB application:

### Determine the start date of a season

With the property **CMB_SEASON_START_DATE** you can specify when an activity season start. It is used in the /activity route to determine which activities to display.

Example:

```properties
# Season starts on February 1st
CMB_SEASON_START_DATE=02-01
```

The default value is February 1<sup>st</sup>. This means that activities for the 2025 season are publicly visible from February 1, 2025 to January 31, 2026. You can change the start of the season by modifying the property.

### Define the length of the Activities table id

The 'Activities' table in the database has an alphanumeric id. To determine the total id length, you can use the **CMB_ACTIVITY_ID_LENGTH** property.

Example:

```properties
# The 'Activities' table has an id lenght of 16 characters
CMB_ACTIVITY_ID_LENGTH=16
```

The default value is a length of 16 characters.

### Specify a cron secret key

**CRON_SECRET_KEY** is a secret key used to secure HTTP requests sent to the application by external services such as cron-job.org. This key is essential to validate incoming calls to specific routes that are performing scheduled tasks (for example, sending reminder emails). It ensures that only genuine requests from authorized sources can trigger these tasks.

The key is used in URLs so *it must be well formatted to avoid any errors*.

```properties
CRON_SECRET_KEY={aKeyYouDefine}
```

The key has no default value. ***It has to be configured***

## Author

The author of this project is [Téo Derboven](https://github.com/teoderboven)