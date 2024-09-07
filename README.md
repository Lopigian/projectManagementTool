## Project Management Tool README

### Introduction

This project is a Laravel-based application that serves as a project management tool, providing both API endpoints and a user interface. It allows users to create, manage, and interact with projects and tasks.

### Postman Collection

We have a Postman Collection ready to interact with the API:
* **Directly Access:** https://api.postman.com/collections/27789161-b2ec0eb3-662a-4330-a9b0-ce8ffcb4e896?access_key=PMAT-01J76GCW8JP4MT6SW7DHS56FMJ


### API Endpoints

The following API endpoints are available:

#### Authentication

-   **POST /auth/register:** Registers a new user.
-   **POST /auth/login:** Authenticates a user and returns an access token.

#### Projects

-   **POST /projects:** Creates a new project.
-   **PUT /projects:** Updates an existing project.
-   **DELETE /projects/{id}:** Deletes a project.
-   **GET /projects/all:** Retrieves a list of all projects.
-   **GET /projects/{id}:** Retrieves a specific project by its ID.

#### Tasks

-   **POST /tasks:** Creates a new task.
-   **PUT /tasks:** Updates an existing task.
-   **DELETE /tasks/{id}:** Deletes a task.
-   **GET /tasks/all:** Retrieves a list of all tasks.
-   **GET /tasks/{id}:** Retrieves a specific task by its ID.

### Usage

1.  **Clone the repository:**

    Bash

    ```
    git clone https://github.com/Lopigian/projectManagementTool
    
    ```

2.  **Install dependencies:**

    Bash

    ```
    composer install
    
    ```

3.  **Configure environment:** Create a `.env` file and set the necessary environment variables, such as database credentials.
4.  **Run migrations:**

    Bash

    ```
    php artisan migrate
    
    ```
5.  **Start the development server:**

    Bash

    ```
    php artisan serve
    
    ```

### API Usage Example

Bash

```
# Register a new user
curl -X POST http://localhost:8000/api/auth/register \
  -H 'Content-Type: application/json' \
  -d '{
    "name": "John Doe",
    "email": "johndoe@example.com",
    "password": "password123"
  }'

# Login and get an access token
curl -X POST http://localhost:8000/api/auth/login \
  -H 'Content-Type: application/json' \
  -d '{
    "email": "johndoe@example.com",
    "password": "password123"
  }'

```
**Note:** Replace `http://localhost:8000` with your actual application URL.

### Additional Notes

-   **Authentication:** API endpoints require authentication using Sanctum.
-   **Error handling:** The API returns appropriate HTTP status codes and error messages.
-   **Data validation:** Input validation is implemented to ensure data integrity.
-   **Security:** Best practices for security are followed, including input sanitization and output encoding.

**This README provides a basic overview of the project. For more detailed information, refer to the code and comments within the project.**
