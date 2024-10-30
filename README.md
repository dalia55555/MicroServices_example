# Microservices Example Project

This project demonstrates a simple microservices architecture using Laravel, consisting of two separate services:
**Product Service** and **Order Service**. 
The Product Service manages product information,
while the Order Service processes orders and retrieves product details from the Product Service.

## Table of Contents

- [Project Overview](#project-overview)
- [Clone the Repository](#clone-the-repository)
- [Installation](#installation)
- [Running the Services](#running-the-services)
- [Database Migration](#database-migration)

## Project Overview

### Services

- **Product Service**: 
  - Responsible for managing products, including adding, updating, retrieving, and deleting product information.
  - simple subscription service to get api_key used in integration.
  
- **Order Service**: 
  - Handles order processing. It requires access to product details from the Product Service to fulfill orders.

## Clone the Repository

To get started, clone the repository using the following command:

```bash
git clone https://github.com/dalia55555/MicroServices_example.git
cd MicroServices_example
```

## Installation

1. Navigate to each service directory and install the necessary dependencies:

   ```bash
   # For Product Service
   cd product-service
   composer install

   # For Order Service
   cd ../order-service
   composer install
   ```

2. Create a `.env` file in both the Product and Order Service directories. You can copy the example file:

   ```bash
   # For Product Service
   cp .env.example .env

   # For Order Service
   cp .env.example .env
   ```

3. Configure your database settings in the `.env` file for each service:

   - `DB_CONNECTION`: Your database connection type (e.g., `mysql`)
   - `DB_HOST`: Database host (default: `127.0.0.1`)
   - `DB_PORT`: Database port (default: `3306` for MySQL)
   - `DB_DATABASE`: Name of your database      for example(ProductSerice in productservice project /OrderService in OrderService project)
   - `DB_USERNAME`: Your database username     for example (root)
   - `DB_PASSWORD`: Your database password     empty

## Running the Services

To run both services, follow these steps:

1. **Run Product Service on port 8001**:

   ```bash
   cd product-service
   php artisan serve --port=8001
   ```

2. **Run Order Service on port 8000**:

   ```bash
   cd ../order-service
   php artisan serve --port=8000
   ```

## Database Migration

To initialize the database for both services, run the migrations:

1. **For Product Service**:

   ```bash
   cd product-service
   php artisan migrate
   ```

2. **For Order Service**:

   ```bash
   cd ../order-service
   php artisan migrate
   ```
