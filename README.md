# Acme Widget Basket System

## Features

- **Product Catalog**: Contains Red, Green, and Blue widgets.
  Here are the available products:

| **Product Name** | **Product Code** | **Price** |
| ---------------- | ---------------- | --------- |
| Red Widget       | R01              | $32.95    |
| Green Widget     | G01              | $24.95    |
| Blue Widget      | B01              | $7.95     |

- **Delivery Charges** based on total amount:
  - Orders < $50: $4.95 delivery fee.
  - Orders < $90: $2.95 delivery fee.
  - Orders >= $90: Free delivery.
- **Special Offers**:
  - "Buy one red widget, get the second half price."

## Requirements

- Docker (for running the app in a containerized environment)
- PHP 8.1
- Composer for managing dependencies

## Installation

1. Clone this repository:

   ```bash
   git clone https://github.com/kesharg/acme-widget-co.git
   cd acme-widget-co
   ```

2. Install dependencies via Composer:

    ### With Docker:

    ```bash
    docker-compose up --build
    ```

    Make sure the application is running by visiting [http://localhost:8080](http://localhost:8080) in your browser.

    ### Without Docker (locally)

    ```bash
    composer install

    php -S localhost:8080

    ```
    Make sure the application is running by visiting [http://localhost:8080](http://localhost:8080) in your browser.


3. To run the PHPUnit specific BasketTest test

      ### With Docker:

      ```bash
      docker-compose exec php ./vendor/bin/phpunit tests/BasketTest.php

      ```

      Or

      ```bash
      docker exec -it php-container ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/BasketTest.php

      ```

      ### Without Docker(locally):

      ```bash
      php ./vendor/bin/phpunit tests/BasketTest.php
      
      ```

4. Run PHPStan static analysis:

      ### With Docker

      ```bash
      docker-compose exec php ./vendor/bin/phpstan analyse
      ```

      ### Without Docker (locally):

      ```bash
      php ./vendor/bin/phpstan analyse
      ```
## Example Baskets:
Example 1: Basket with Blue and Green Widgets
Products: B01, G01
Total: $37.85

Example 2: Basket with Two Red Widgets (with Offer)
Products: R01, R01
Total: $54.37

Example 3: Basket with Red and Green Widget
Products: R01, G01
Total: $60.85

Example 4: Basket with Multiple Red Widgets (with Offer)
Products: B01, B01, R01, R01, R01
Total: $98.27

## Design and Assumptions:
Product Codes: Each product has a unique code (e.g., R01 for the red widget).
Pricing: Prices are retrieved from a JSON file (data/products.json).
Discount Logic: The "buy one red widget, get the second half price" offer applies only to red widgets (R01).
Delivery: Delivery charges are calculated based on the basket total:
Below $50: $4.95
Below $90: $2.95
$90 or more: Free delivery.
## Design Patterns and Best Practices

This project follows several key design principles to ensure maintainability, flexibility, and clarity:

### Sensible Types
I use appropriate and meaningful data types for each variable and method argument/return. For example, prices are handled as `float`, product codes as `string`, and collections of items as `array`.

### Good Separation/Encapsulation
The code follows good separation of concerns, where each class or module has a single responsibility. Internal implementation details are encapsulated to promote maintainability and reduce complexity.

### Small Accurate Interfaces
I strive to keep our interfaces small and focused. Each class exposes only the methods that are necessary for its functionality, making it easier to understand and use.

### Dependency Injection
Dependency injection is used to pass dependencies like delivery and offer strategies into classes, making them easier to test and maintain. This decouples components and makes the code more flexible.

### Strategy Pattern
The strategy pattern is applied to allow different algorithms for delivery and offers. This makes it easy to change or extend the logic for pricing and delivery calculations without affecting the rest of the codebase.

## Contributing:
Feel free to fork the repository and submit pull requests. Contributions are welcome!

## License:
This project is licensed under the MIT License.

