# HTTPClient Class Documentation

The `HTTPClient` class is a PHP class designed to make HTTP requests using the WordPress API. It provides methods for making GET, POST, PUT, and DELETE requests with ease. This class is especially useful for developers who are working on WordPress plugins or themes and need to interact with external APIs or remote services.

## Installation

```
composer require shewa12/wp-http-client
```

## Instantiating the HTTPClient Class

To use the `HTTPClient` class, create an instance of it as follows:

```php
use Shewa\WP_HTTP_Client\HTTPClient;

// Instantiate the HTTPClient class
$http_client = new HTTPClient();
```

## Usage

`request()` method is responsible for performing http requests. This method accept four params. These are:

- $request, required. Which request need to make. Supported values: get, post, put, patch, delete.
- $url, required. Where to make request
- $data required if request is not get or delete
- $args optional, pass to override default values

Example of get request:
```php
    $url = 'https://api.example.com/data';
    $response = $http_client->request( 'get', $url );

    if ( ! is_wp_error( $response ) ) {
        // Process the response data
        print_r( $response );
    } else {
        // Handle the error
        echo 'Error: ' . $response->get_error_message();
    }

```

Example of post request:
```php
    $url = 'https://api.example.com/data';
	$data = ['name' => 'John'];
    $response = $http_client->request( 'post', $url, $data );

    if ( ! is_wp_error( $response ) ) {
        // Process the response data
        print_r( $response );
    } else {
        // Handle the error
        echo 'Error: ' . $response->get_error_message();
    }

```

## Response

Response will be either WP_Error or Array. 

Successful response will return array like below:
```php
		$response = array(
			'headers' => [],
			'code'    => 200,
			'message' => 'OK',
			'body'    => [],
		);
```

## Methods
- REQUEST
- GET
- POST
- PUT
- PATCH
- DELETE

## Supported HTTP Arguments & Default Values

```php
		$defaults = array(
			'method'              => 'GET',
			'timeout'             => 5,
			'redirection'         => 5,
			'httpversion'         => 1.0,
			'user-agent'          => 'WordPress/' . get_bloginfo( 'version' ) . '; ' . get_bloginfo( 'url' )',
			'reject_unsafe_urls'  => false,
			'blocking'            => true,
			'headers'             => array(),
			'cookies'             => array(),
			'body'                => null,
			'compress'            => false,
			'decompress'          => true,
			'sslverify'           => true,
			'sslcertificates'     => ABSPATH . WPINC . '/certificates/ca-bundle.crt',
			'stream'              => false,
			'filename'            => null,
			'limit_response_size' => null,
		);
```
