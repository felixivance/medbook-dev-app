Health Records Management System

Installation Procedure

Clone the repository from https://github.com/felixivance/medbook-dev-app.git
 with :
 
 git clone https://github.com/felixivance/medbook-dev-app.git
 
 Install the dependencies with:
 
 1. Npm install
 2. composer install
 
 Create a database eg medbook-dev-app
 
 Setup the database on your .env file with the correct information like database name and password
 
 Then finally run:
  
  1. php artisan key:generate
  2. php artisan migrate:fresh --seed
  3. php artisan passport:install
  
  Once your project has been created and the commands run successfully,
  
  Run:
  
  php artisan serve 
  
  to start the project and use the credentials
  
  admin@hrms.com as the email and password12345 as the password
  
  Login Page should look like the screenshots in public/screenshots
  
  

 
