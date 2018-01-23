<?php

class WPML_TM_Package_Element extends WPML_TM_Translatable_Element {

	/** @var WPML_ST_Package_Factory $st_package_factory */
	private $st_package_factory;

	/** @var WPML_Package $st_package */
	private $st_package;

	/**
	 * @param                              $id
	 * @param SitePress                    $sitepress
	 * @param wpdb                         $wpdb
	 * @param WPML_ST_Package_Factory|null $st_package_factory
	 */
	public function __construct(
		$id,
		SitePress $sitepress,
		wpdb $wpdb,
		WPML_ST_Package_Factory $st_package_factory = null
	) {
		$this->st_package_factory = $st_package_factory;
		parent::__construct( $id, $sitepress, $wpdb );

	}

	/** @param int $id */
	protected function init( $id ) {
		if ( $this->st_package_factory ) {
			$this->st_package = $this->st_package_factory->create( $id );
		}
	}

	/** @return int */
	public function get_words_count() {
		$result = 0;

		if ( $this->st_package ) {
			$lang    = $this->st_package->get_package_language();
			$strings = $this->st_package->get_package_strings();

			if ( $strings ) {
				foreach ( $strings as $string ) {
					$result += $this->get_string_words_count( $lang, $string->value );
				}
			}
		}

		return $result;
	}

	/**
	 * @param null $label
	 *
	 * @return string
	 */
	public function get_type_name( $label = null ) {
		if ( $this->st_package ) {
			return $this->st_package->kind;
		}

		return __( 'Unknown string Package', 'wpml-translation-management' );
	}
}
