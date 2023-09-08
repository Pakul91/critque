## Requirements

Before proceeding, please ensure that you have the following requirements in place:

- Node.js installed on your machine.
- Artisan installed on your machine.
- A suitable environment for running your MySQL database, such as XAMPP.

Once that is sorted :

## The following commands will get you up and running.

### Pull and prepare the project

```
$ git clone https://github.com/Pakul91/critque.git
```

```
$ cd ascensor-full-stack-test-2023
```

```
$ cp .env.example .env
```

### install composer and the node modules.

```
$ composer install
```

```
$ npm i
```

### Populate data and start the project

```
$ php artisan migrate:refresh –seed
```

```
$ php artisan serve
```

```
$ npm run dev
```

The application should now be available at http://localhost:8000.

## Database backup file is saved in database/backup folder
