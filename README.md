## Library Management System (Laravel)

This project implements a basic Library Management System (LMS) using Laravel framework. The system allows users to borrow books, manage their borrowing records, and rate books. 

Features:

* User Authentication: Utilizes JWT for secure user authentication and authorization.
* Book Management (Admin): CRUD operations for books, including creation, viewing, updating, and deleting books.
* User Management (Admin): CRUD operations for users, including creation, viewing, updating, and deleting users.
* Borrowing System(Borrower): Allows registered users to borrow books.
    * Checks book availability before allowing borrowing.
    * Sets a due date (14 days after borrowing).
* Borrow Record Management (Borrower): Allows users to view their borrowing records, mark books as returned, and update due dates. 
* Book Rating: Allows users to rate books they have borrowed.
* Book Filtering: Provides an API for filtering books by author, category, and availability.

Technology Stack:

* Laravel Framework
* MySQL Database
* JWT Authentication
* Spatie Roles & Permissions 
* Form Requests for Validation 
* Postman for API testing

Instructions:

1. Clone the repository:
    
    git clone https://github.com/your-username/library-management-system.git
    
2. Install dependencies:
    
    composer install
    
3. Create a new database:
    * Create a new database in your database server.
4. Update database credentials:
    * Open `.env` file and update the database credentials.
5. Run migrations:
    
    php artisan migrate
    
6. Run seeders:
    
    php artisan db:seed
    
7. Start the development server:
    
    php artisan serve
    
8. Access the API endpoints:
    * Use the provided Postman collection to test the API endpoints.

Documentation:

* Each code file includes docblocks for detailed documentation.
* Postman Collection: 
    * The Postman Collection file contains requests for all API endpoints. 

Contributing:

Contributions are welcome! Please submit a pull request with your changes.


Contact:

For any questions or inquiries, feel free to contact me.