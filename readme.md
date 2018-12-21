# Voting System

This is an application made with laravel 5.4, php 5.6 and mysql, just for learning purposes.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

You'll need to install these software in your local machine

```
- xampp, wamp or lamp environment: https://www.apachefriends.org/index.html
- composer: https://getcomposer.org/
- laravel: https://laravel.com/docs/5.7/installation
- postman: https://www.getpostman.com/apps
```

### Installing

Assuming that everything above is installed and running, these are the next steps:

Clone this repository into your public local folder. Lets say you have your default xampp folder, it would be:

```
xampp\htdocs
```

Create a virtual host in your xampp server and point it to xampp/htdocs/your-project/public/

Laravel public folder is where the website runs.

Create a new database in mysql, call it 'voting'. Copy your database name, username, password and find the file .env in the root of the project. Edit these values

```
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=voting
	DB_USERNAME=root
	DB_PASSWORD=
```

Repeat the same in /config/database.php, line 36:

```
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', 'voting'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', ''),
```

You'll need to run the migrations in the root folder of your project using the command prompt:

```
	php artisan migrate --path=/database/migrations/1st

	php artisan migrate --path=/database/migrations/2nd

	php artisan migrate --path=/database/migrations

	php artisan migrate
```

and then run the seeds:

```
    php artisan db:seed
```

With this your database should be set.

## Running the API

To test the API, you need to run postman in your computer. 

### API endpoints

These are the endpoints

```
your-local-url/api/login?username=john@doe.com&password=321cba

your-local-url/api/login?username=jane@doe.com&password=123abc
```

This app has two users as requested in the word DOC file

To login with these users, you will need to create two encryption keys only one time, this will be an unique keys for each machine that this app is installed. 

NOTE: you will only have to do this one time, you dont need to do this again unless you install the app in another server.

you have to run this commmand in the prompt console:

```
php artisan passport:install
```

and it will create two client ID and Client Secret, one ID is for Personal access and the second is for Password access. We are going to use password access to login users.

you should get a result in the prompt like this:

```
Personal access client created successfully.
Client ID: 1
Client Secret: 3MNAwRQ5qXHeTS1qM3kAC0wM7x4WwpaZFRHfpK8o
Password grant client created successfully.
Client ID: 2
Client Secret: moKGrXqPq6Aj86aZsuJwhm8yQe9iHmqnWCnF6jvM
```

Copy Client secret and go to .env file and to /Config/Auth.php

In .env edit:

```
OAUTH_CLIENT_ID=2
OAUTH_CLIENT_SECRET=moKGrXqPq6Aj86aZsuJwhm8yQe9iHmqnWCnF6jvM
```

In /Config/Auth.php, line 102 edit:

```
'client_id' => env('OAUTH_CLIENT_ID', '2'),
'client_secret' => env('OAUTH_CLIENT_SECRET', 'moKGrXqPq6Aj86aZsuJwhm8yQe9iHmqnWCnF6jvM'),
```

Now that you have set your Client Secret, you can login to the API.

Try login with one of the two users:

```
your-local-url/api/login?username=john@doe.com&password=321cba

your-local-url/api/login?username=jane@doe.com&password=123abc
```

If you use postman, go to Headers, and add:

```
Key: Accept
Value: "application/json"
```

Do this for every API call in postman.

To login, use the POST method.

When you do an API call with this users, you should get a response with an 'access_token' and a 'refresh_token':

```
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY1ZGRhY2VkMmM0MWRjYTVjMGQ2MzdjZWMzZDk5OTU1NzBiZGQ2NTJiZjVlMTkxYTU0ZWFhODg4YjMxZjk1NzA0Mzg3NjBjNDNjOThlNWIxIn0.eyJhdWQiOiIyIiwianRpIjoiZjVkZGFjZWQyYzQxZGNhNWMwZDYzN2NlYzNkOTk5NTU3MGJkZDY1MmJmNWUxOTFhNTRlYWE4ODhiMzFmOTU3MDQzODc2MGM0M2M5OGU1YjEiLCJpYXQiOjE1NDU0MzA0MTAsIm5iZiI6MTU0NTQzMDQxMCwiZXhwIjoxNTc2OTY2NDEwLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.MNECTQQbeARqLsVNE_vnnGYP6u95pTKwRCqID9xrMkBf7Zj8_Bicv_dPy4fy0QsSJrm_Z7FdEnB_KfncZvo7ApKpXKxGJ_ZZJm28IJMcuhANJ9mQ8lWnL9XkTiLmjCptrqiED08wfKkaI63N2aUvlo4EzpfweE-C3om4ak_yGdmDUZX3HXXPqqJEqmgo8tHTjQfVPIyA1UMXuNIf4pwkcN_7ls1ml3lf5ywQ7gUCdSuZRsduzOIcfZt13Cw_3e3Lt083Y_SyyYGLChS_soxP661I3HA1-wbqD0-A_Lwv1-AwAaPySYYkF5LzsKNTUIftEMFRUT6DylOvefkbInJrv8ohMgB420a2QJ1JbAzxXZQJ4JgXKAkoY_n25O3LRs78A50qK0ZV_0vXXzbePl-2VDdpobLTb6VXmWrWzGKdFZ2FIG3zsiMNqrXTe1R_05JWiR0uQOpyMZsdUiWJXoQbYkSZTUotkBGqnvez9IUn-4KzMo3tfIKsvR2lF4rNlHOd23UwJk09gMoJlTdZ1DzY20pUB0peJKOXAenrrhSAwcwH-dSuO_93oAqeoKkMv18aOHBN3zQHwc6JLWgzElGzXefr643GuNdhsL58W4YeEju1aluyeS5JxlJMlcsrvz8Ssh3Tke-KaG912qfy-2VlDQstVR0CBItKWwYcn5-Y-18",
    "refresh_token": "def50200960e7afefcfebb7745b0d36079f0e9980172ac3f802daffb6e6b196a3f52b410c6b83da02e208b4965c56b4b14cc15b28cfcca49aede6b55bfa462a3b75f44d32b2541dfd5db90c77196356c8aa9827826b6cdf629f68e066d609adf45b19d343a526a1e86da85e7daad507fd9160e346d209ec95251b26d4f413626bc0960572f37969c39a66b8cc61ba37f0669f4835bbad96ddf4b8e93777ab13703c039b2eac969cc8a79c65141e55525dea58fef99b8237cab176769cade501ef85ee47795fd0166bbf74f9bbd7a4f9752db54b76d457908ffd8539d7a16393b185028a88ab5f8f56d0ce51b26925fe8da7b9401ba222894c7090c8a4438ae65b6cc92e6630a77ebe2526fa7e869b1a432b4a456097ceb791607fdcc9bf6177210ef818abc0e74e6217954181a714b38048dd7251674ebb102ee9d60621fac6dd50d32e74154074f9263608f67acdfd6f4613effbe2ab2b4d4e34ede61902d71a6"
}
```

You will need the 'access_token' for the other API calls (for consulting the votes and for voting), because its the validation that the user is logged in. 

Every user can vote only once, being logged in asure that you don't vote twice.

The endpoint for consult the list of votes is the following:

```
your-local-url/api/votes
```

To use this endpoint, use the GET method.

In headers, add:

```
Key: Accept
Value: "application/json"

Key: Authorization
Value: "Bearer your-access-token"
```

You should get a response like this:

```
[
    {
        "id": 4,
        "name": "Pineapple",
        "created_at": null,
        "updated_at": null,
        "votes": 0
    },
    {
        "id": 3,
        "name": "Banana",
        "created_at": null,
        "updated_at": null,
        "votes": 0
    },
    {
        "id": 2,
        "name": "Orange",
        "created_at": null,
        "updated_at": null,
        "votes": 0
    },
    {
        "id": 1,
        "name": "Apple",
        "created_at": null,
        "updated_at": null,
        "votes": 0
    }
]
```

The response will return ordered on top who gets more votes, on botton who gets less votes.

The endpoint to vote is the following:


```
your-local-url/api/votes/the-fruit-id/fruit
```

replace the-fruit-id with the id of the previous result, that belongs to a fruit that you want to vote.

example: voting.loc/api/votes/4/fruit. this will vote by "Pineapple"

Use POST method.

In headers, add:

```
Key: Accept
Value: "application/json"

Key: Authorization
Value: "Bearer your-access-token"
```

After consulting the API call, you should receive a message like this:

```
{
    "message": "success"
}
```

If you vote again with the same user, you should get a message like this:


```
{
    "message": "user already voted"
}
```

If you consult the votes again, you should see your vote:


```
[
    {
        "id": 4,
        "name": "Pineapple",
        "created_at": null,
        "updated_at": null,
        "votes": 1
    },
    {
        "id": 3,
        "name": "Banana",
        "created_at": null,
        "updated_at": null,
        "votes": 0
    },
    {
        "id": 2,
        "name": "Orange",
        "created_at": null,
        "updated_at": null,
        "votes": 0
    },
    {
        "id": 1,
        "name": "Apple",
        "created_at": null,
        "updated_at": null,
        "votes": 0
    }
]
```