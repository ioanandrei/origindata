# Installation
Please run the following commands:

1. clone the repository
2. `composer install`
3. `php artisan migrate:fresh --seed`

# Running the app
I was not able to dockerize the app in time so please set up the app on your own.

# Authorization
You'll need to use a `bearer token` in order to access the API. For testing purpose I save the tokens in a table in order
for you to access them.

You can find this tokens in 2 places:

1. In the database, in the table called `test_tokens`
2. In the main (and only) page of the app. You can access it by going on the link: `http://test.app/`. You'll find a
   list there.

# Testing the app
You can test the app using one of the following commands:
1. `php artisan test`
2. `./vendor/bin/pest`

# Routes
The application routes are the following:

1. Companies
   1. `GET /companies` 
   2. `GET /companies/{companyId}` 
   3. `PUT /companies/{companyId}` 
   4. `DELETE /companies/{companyId}`
2. Projects
   1. `GET /companies/{companyId}/projects`
   2. `GET /companies/{companyId}/projects/{projectId}`
   3. `POST /companies/{companyId}/projects`
   4. `PUT /companies/{companyId}/projects/{projectId}`
   5. `DELETE /companies/{companyId}/projects/{projectId}`
3. Employees
    1. `GET /companies/{companyId}/employees`
    2. `GET /companies/{companyId}/employees/{employeeId}`
    3. `POST /companies/{companyId}/employees`
    4. `PUT /companies/{companyId}/employees/{employeeId}`
    5. `DELETE /companies/{companyId}/employees/{employeeId}`
