## System Requirement
* Laravel - 11.x
* php - 8.2.x
* npm - 10.5.x
* composer - 2.x  

## Installation
*  Open terminal, navigate to your work directory and execute the following command:   
`git clone https://github.com/gajendrarahul/assessment.git` or `git clone git@github.com:gajendrarahul/assessment.git`    
*  Navigate to the project directory : `cd assessment`
*  Install Composer Dependencies: `composer install`
* Install npm dependencies `npm install && npm run dev`
*  Copy the _.env.example_ file to _.env_ file : `cp .env.example .env`
*  Generate the Application key: `php artisan key:generate`
*  Set up database details inside `.env` file :    
```
DB_CONNECTION=sqlite
```
* Run the migration and seeders: `php artisan migrate`

*  Set github 0auth credentials inside `.env` file :    

```
GITHUB_CLIENT_ID=""
GITHUB_CLIENT_SECRET=""
GITHUB_REDIRECT="http://127.0.0.1:8000/login/github/callback"
```
* Run `php artisan serve`

* Visit page http://127.0.0.1:8000


