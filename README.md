# Laravel Subscription Platform

A simple subscription platform app with made Laravel.

This is a simple, minimal and quickly developed (in 2-3 hours simultaneously learning Laravel) simple subscription platform app made with Laravel following the project instructions. There are lots of possibilities to upgrade this app.

## Project instructions

The following instruction were provided.

    Create a simple subscription platform(only RESTful APIs with MySQL) in which users can subscribe to a website (there can be multiple websites in the system). Whenever a new post is published on a particular website, all it's subscribers shall receive an email with the post title and description in it. (no authentication of any kind is required)

    MUST:-
    - Use PHP 7.* or 8.*
    - Write migrations for the required tables.
    - Endpoint to create a "post" for a "particular website".
    - Endpoint to make a user subscribe to a "particular website" with all the tiny validations included in it.
    - Use of command to send email to the subscribers (command must check all websites and send all new posts to subscribers which haven't been sent yet).
    - Use of queues to schedule sending in background.
    - No duplicate stories should get sent to subscribers.
    - Deploy the code on a public github repository.

    OPTIONAL:-
    - Seeded data of the websites.
    - Open API documentation (or) Postman collection demonstrating available APIs & their usage.
    - Use of contracts & services.
    - Use of caching wherever applicable.
    - Use of events/listeners.

    Note:-
    1. Please provide special instructions(if any) to make to code base run on our local/remote platform.
    2. Only implement what is mentioned in brief, i.e. only the API, no front-end things etc. The codes will never be deployed, we just want to see your coding skills.
    3. There isn't a strict deadline. The faster the better, however code quality (and implementing it as mentioned in brief) is the most important. However, of course it shouldn't take more than a couple of hours.
    4. Don't use AI at any point. We have detection mechanisms that find out if you do; it would disqualify you immediately.
    5. If anything isn't clear, just implement it according to your understanding. There won't be any further explanations, the task is clear. As long as what you do doesn't contradict the briefing, it's fine.

## Possible Features/Upgrades

-   Full Admin API.
-   Full frontend API to access websites, posts etc with all REST options.
-   Saperate notification tables.
-   Purify/Sanitize story description input.
-   ...more.

## Installation

1. Clone this repository.
1. Install Composer dependencies.
    ```bash
    composer install
    ```
1. Copy `.env.example` to `.env` and set values.
    - APP_KEY - Generate with `php artisan key:generate`.
    - DB connection config - Set only if you want to use anything other then sqlite.
        - DB_CONNECTION
        - DB_HOST
        - DB_PORT
        - DB_DATABASE
        - DB_USERNAME
        - DB_PASSWORD
    - MAIL config - Depending on your preferred mail tester.

## Database and migrations

Development environment used sqlite database but you can setup any other that Laravel supports. Run the migrate command with seed option to setup and import data.

The Seeder includes seed data for websites and subscribers. Other data has to be added manually via API.

```bash
php artisan migrate --seed
```

## Running application and services

To start the server run the following command in separate terminals.

1. Start PHP development server.
    ```bash
    php artisan serve
    ```
1. Run queue jobs.
    ```bash
    php artisan queue:work
    ```

Access the application in the browser via the development url http://127.0.0.1:8000/ or the url provided by `php artisan serve` command.

## API endpoints

The following endpoints are available.

-   All endpoints are prefixed with `/api`.
-   All request body must be in JSON format.

### GET /api/website

Returns list of all websites.

### POST /api/website

Add a new website.

**Body Parameters**

|     Name | Required |  Type  | Description                  |
| -------: | :------: | :----: | ---------------------------- |
| `domain` | required | string | Domain name of the website . |

### GET /api/website/{domain}

Returns a website.

**URL Parameters**

|     Name | Required |  Type  | Description                 |
| -------: | :------: | :----: | --------------------------- |
| `domain` | required | string | Domain name of the website. |

### PUT|PATCH /api/website/{domain}

Update website.

**URL Parameters**

|     Name | Required |  Type  | Description                  |
| -------: | :------: | :----: | ---------------------------- |
| `domain` | required | string | Domain name of the website . |

**Body Parameters**

|     Name | Required |  Type  | Description                 |
| -------: | :------: | :----: | --------------------------- |
| `domain` | required | string | Domain name of the website. |

### DELETE /api/website/{domain}

Deletes the website.

### POST /api/website/{domain}/post

Adds a new post to the provided website.

**URL Parameters**

|     Name | Required |  Type  | Description                 |
| -------: | :------: | :----: | --------------------------- |
| `domain` | required | string | Domain name of the website. |

**Body Parameters**

|          Name | Required |  Type  | Description       |
| ------------: | :------: | :----: | ----------------- |
|         `url` | required | string | Url of the post.  |
|       `title` | required | string | Post title.       |
| `description` | required | string | Post description. |

### POST /api/website/{domain}/subscribe

Subscribe to a website

**URL Parameters**

|     Name | Required |  Type  | Description                 |
| -------: | :------: | :----: | --------------------------- |
| `domain` | required | string | Domain name of the website. |

**Body Parameters**

|    Name | Required |  Type  | Description         |
| ------: | :------: | :----: | ------------------- |
| `email` | required | string | Email to subscribe. |
