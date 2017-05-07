<?php

/**
 * The Web Router Handles the follwoing logics :
 *
 * 1) loads the Page
 *
 */
class WebRouter extends BaseRouter{

	private $ret;
	protected $logger;

	public function __construct( $urlParser ){

		global $logger;

		parent::__construct( $urlParser );

		$this->logger = $logger;
	}

	/**
	 * resolves the namespace.
	 * formulates the path
	 * and includes the page file where it is lying
	 */
	private function resolveNameSpace(){

		$page_path = 'ui/page/';

		$name_space = explode( '::', $this->name_space );

		if( !is_array( $name_space ) )
			$name_space = array( $name_space );

		$name_space = implode( '/', $name_space );
		$page_path .= $name_space . '/' . ucfirst( $this->page ) . 'Page.php';

		try{

			include_once $page_path;
		}catch( Exception $e ){

			include_once "404Page.html";
			$this->logger->debug( "PAGE NOT FOUND ".$e->getMessage() );
			die();
		}
	}

	/**
	 * Initilized the page with the arguments
	 * and routes it to the proper page.
	 *
	 * Also maps the arguments passed to the page is proper or not.
	 *
	 * The page takes care of rendering and processing of each widgets
	 */
	private function route( $page ){

	}

	/**
	 * renders the page by passing the handling to the page.
	 * @param unknown_type $page
	 */
	private function renderPage( $page ){

		$page->render();
	}

	/**
	 * Redirect To the proper page
	 */
	public function doRedirect( ){
		
		$this->resolveNameSpace();

		$page = ucfirst( $this->page ) . 'Page' ;
		$page = new $page();

		$this->route( $page );
		$page->process( );

		ob_get_clean();

		$this->renderPage( $page );
	}
}
?>
