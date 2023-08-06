<?php
/**
 * HTTPClient class
 *
 * Makes HTTP requests using the WordPress API.
 *
 * @package Shewa\WP\HTTPClient
 * @author  shewa<shewa12kpi@gmail.com>
 * @link    https://shewazone.com
 * @since   1.0.0
 */

namespace Shewa\WP_HTTP_CLIENT;

/**
 * HttpClient class
 */
class HTTPClient {

	/**
	 * Arguments for HTTP requests.
	 *
	 * @var array
	 */
	private $arguments = array(
		'timeout' => 50,
		'headers' => array(
			'Content-Type: application/x-www-form-urlencoded',
		),
	);

	/**
	 * Make a GET request
	 *
	 * @since 1.0.0
	 *
	 * @param string $url URL to request.
	 * @param array  $args Arguments for the request.
	 *
	 * @return array|WP_Error Response data or WP_Error on failure.
	 */
	public function get( $url, array $args = array() ) {
		$args = wp_parse_args( $args, $this->arguments );

		$response = wp_remote_get( $url, $args );
		return $this->handle_response( $response );
	}

	/**
	 * Make a POST request
	 *
	 * @since 1.0.0
	 *
	 * @param string $url URL to request.
	 * @param array  $data Data to post.
	 * @param array  $args Arguments for the request.
	 *
	 * @return array|WP_Error Response data or WP_Error on failure.
	 */
	public function post( $url, $data, array $args = array() ) {
		// Update arguments.
		$this->arguments['body'] = $data;

		$args = wp_parse_args( $args, $this->arguments );

		$response = wp_remote_post( $url, $args );
		return $this->handle_response( $response );
	}

	/**
	 * Make a PUT request
	 *
	 * @since 1.0.0
	 *
	 * @param string $url URL to request.
	 * @param array  $data Data to put.
	 * @param array  $args arguments for the request.
	 *
	 * @return array|WP_Error Response data or WP_Error on failure.
	 */
	public function put( $url, $data, array $args = array() ) {
		// Add body & method elements to the arguments.
		$this->arguments['body']   = $data;
		$this->arguments['method'] = 'PUT';

		$args = wp_parse_args( $args, $this->arguments );

		$response = wp_remote_request(
			$url,
			$args
		);

		return $this->handle_response( $response );
	}

	/**
	 * Make a DELETE request
	 *
	 * @since 1.0.0
	 *
	 * @param string $url URL to request.
	 * @param array  $args Arguments for the request.
	 *
	 * @return array|WP_Error Response data or WP_Error on failure.
	 */
	public function delete( $url, array $args = array() ) {
		// Add method element to the arguments.
		$this->arguments['method'] = 'DELETE';

		$args = wp_parse_args( $args, $this->arguments );

		$response = wp_remote_request( $url, $args );

		return $this->handle_response( $response );
	}

	/**
	 * Handle response and return data or WP_Error
	 *
	 * @since 1.0.0
	 *
	 * @param array|WP_Error $response Response data or WP_Error.
	 * @return array|WP_Error Response data or WP_Error.
	 */
	private function handle_response( $response ) {
		if ( is_wp_error( $response ) ) {
			return $response;
		}

		$data = json_decode( wp_remote_retrieve_body( $response ), true );
		if ( $data && ! is_wp_error( $data ) ) {
			return $data;
		}

		return new \WP_Error(
			'invalid_response',
			'The response from the request was invalid.'
		);
	}
}
