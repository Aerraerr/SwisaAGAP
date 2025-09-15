# SwisaAGAP: Agricultural Grant and Equipment Acquisition System 

**SWISA-AGAP** is a digital system designed to support farmers, fishers, swine producers, and small agribusiness owners in Sorsogon. This platform enables efficient grant requests, resource monitoring, and program management through a web-based admin dashboard and a mobile app for members.

---  
       
## 📌 Features 
     
### 👤 For Members (Mobile App)  
- 📋 Submit support/grant requests
- 🔍 View available programs and services
- ⏱️ Track request status (pending, approved, rejected)
- 🗓️ Receive announcements, schedules, and updates
- 📁 Access learning materials and guides

### 🖥️ For Admins (Web Dashboard)
- 📊 View summary statistics and charts
- ✅ Approve or reject member requests
- 🔄 Monitor program engagement and request trends
- 📂 Manage member profiles and submitted proposals
- 📈 Generate reports and view analytics
- 📦 Track top requested equipment and grants
- ⚠️ View pending tasks and feedback

---



## INSTALLATION AND USAGE INSTRUCTIONS

### Prerequisites
- PHP >= 8.0
- Composer
- MySQL
- Node.js & npm
- Git

## Steps

#### 1. Clone the repository: First, clone the project from your Git repository
```sh
    https://github.com/Aerraerr/SwisaAGAP.git
    cd ARTieh
```

#### 2. Install PHP Dependencies: Use Composer to install the required PHP dependencies for Laravel
```sh
    composer install
```

#### 2.1 Install Doctrine DBAL: This package is often required for database migrations and schema management.
```sh
    composer require doctrine/dbal
```

#### 3. Install JavaScript Dependencies: Install the required JavaScript packages (Bootstrap, etc.) using npm
```sh
    npm install
```

#### 4. Set Up Environment Variables: Create a .env file by copying the example file
```sh
    cp .env.example .env
```

#### 5. Open the .env file and update the following variables to match your local environment
```sh
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE= swisaagap_db
    DB_USERNAME=root
    DB_PASSWORD=""
```

#### 6. Go to your XAMPP and create a database named "swisaagap_db", make sure your XAMPP server is running

#### 7. Run the Artisan Key Generate Command
```sh
    php artisan key:generate
```

#### 8. Run the artisan migrate command to migrate the database to your local machine
```sh
    php artisan migrate
```

#### 9. Run the database seed command to populate your database
```sh
    php artisan db:seed
```

#### 10. Run the Application: Finally, run the application locally
```sh
    php artisan serve
```

The application will be available at [http://localhost:8000](http://localhost:8000)
