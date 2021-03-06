<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/models/Params.php';
require_once __DIR__ . '/models/Token.php';
require_once __DIR__ . '/models/File.php';
require_once __DIR__ . '/models/Feed.php';
require_once __DIR__ . '/models/Response.php';

use Rss\Feed;
use Rss\Params;
use Rss\Response;
use Rss\Token;

try {
	//validate
	if ( $token = Params::getVal( 'token' ) ) {
		Token::validate( $token );
	}

	//build feed
	if ( ( $title = Params::getVal( 'title' ) ) && ( $description = Params::getVal( 'description' ) ) ) {
		$feed = new Feed( $title, $description );

		if ( $link = Params::getVal( 'link' ) ) {
			$feed->setLink( $link );
		}
		if ( $imageUrl = Params::getVal( 'image' ) ) {
			$feed->setImage( $imageUrl );
		}

		$feed->post();
	}

	echo Response::success( 'Success 😊' );
} catch ( Exception $e ) {
	echo Response::error( $e->getMessage() );
}
