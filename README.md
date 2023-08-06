# HTTPClient Class Documentation

The `HTTPClient` class is a PHP class designed to make HTTP requests using the WordPress API. It provides methods for making GET, POST, PUT, and DELETE requests with ease. This class is especially useful for developers who are working on WordPress plugins or themes and need to interact with external APIs or remote services.

## Installation

To use the `HTTPClient` class, you need to include the file containing the class in your WordPress project. You can either manually include the file or use an autoloader if you have one set up for your project.

## Instantiating the HTTPClient Class

To use the `HTTPClient` class, create an instance of it as follows:

```php
use Shewa\WP_HTTP_Client\HTTPClient;

// Instantiate the HTTPClient class
$http_client = new HTTPClient();
```
