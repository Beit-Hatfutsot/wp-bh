<?php

/**
 * @author OnTheGo Systems
 */
class WPML_TM_ICL20_Migration_Notices {
	const NOTICE_GROUP                  = 'icl-20-migration';
	const NOTICE_MIGRATION_REQUIRED_ID  = 'icl-20-migration';
	const NOTICE_MIGRATION_COMPLETED_ID = 'icl-20-migration-completed';
	private $notices;
	private $progress;

	public function __construct( WPML_TM_ICL20_Migration_Progress $progress, WPML_Notices $notices ) {
		$this->progress = $progress;
		$this->notices  = $notices;
	}

	public function run( $requires_migration = false ) {
		$this->clear_migration_required();

		$has_migration_ever_started = $this->progress->has_migration_ever_started();

		if ( ! $this->progress->requires_migration() && $has_migration_ever_started ) {
			$this->build_migration_completed();
		} else {
			if ( ! $has_migration_ever_started
			     && $requires_migration
			     && ! $this->progress->is_migration_incomplete() ) {
				$this->build_migration_required();
				add_action( 'wpml-notices-scripts-enqueued', array( $this, 'admin_enqueue_scripts' ) );

				return;
			}
			if ( $has_migration_ever_started && ! $this->progress->is_migration_done() ) {
				$this->build_migration_failed();

				return;
			}
		}
	}

	public function clear_migration_required() {
		$this->notices->remove_notice( self::NOTICE_GROUP, self::NOTICE_MIGRATION_REQUIRED_ID );
	}

	private function build_migration_failed() {
		$message = array();
		$actions = array();

		$title     = '<h3>' . esc_html__( 'ICanLocalize migration could not complete',
		                                  'wpml-translation-management' ) . '</h3>';
		$message[] = esc_html__( 'WPML needs to update your connection to ICanLocalize, but could not complete the change.',
		                         'wpml-translation-management' );

		$locked = $this->progress->are_next_automatic_attempts_locked();
		if ( $locked ) {
			$message[] = esc_html__( 'Please contact WPML support and give them the following debug information:',
			                         'wpml-translation-management' );

			$error = '<pre>';
			foreach ( $this->progress->get_steps() as $step ) {
				$completed_step = $this->progress->get_completed_step( $step );
				if ( ! $completed_step || WPML_TM_ICL20_Migration_Progress::STEP_FAILED === $completed_step ) {
					$error .= esc_html( sprintf( __( 'Failed step: %s',
					                                 'wpml-translation-management' ),
					                             $step ) ) . PHP_EOL;
					break;
				}
			}

			$error     .= esc_html( $this->progress->get_last_migration_error() );
			$error     .= '</pre>';
			$message[] = $error;
		} else {
			$message[] = esc_html__( 'Please wait a few minutes and try again to see if there’s a temporary problem.',
			                         'wpml-translation-management' );
		}

		$text   = $title . '<p>' . implode( '</p><p>', $message ) . '</p>';

		$button_label = __( 'Try again', 'wpml-translation-management' );
		$button_url   = add_query_arg( array(
			                               WPML_TM_ICL20_Migration_Support::PREFIX
			                               . 'nonce'                                          => wp_create_nonce( WPML_TM_ICL20_Migration_Support::PREFIX
			                                                                                                      . 'reset' ),
			                               WPML_TM_ICL20_Migration_Support::PREFIX
			                               . 'action'                                         => WPML_TM_ICL20_Migration_Support::PREFIX
			                                                                                     . 'reset',
		                               ) ) . '#icl20-migration';

		$retry_action = $this->notices->get_new_notice_action( $button_label, $button_url, false, false, true );

		$actions[] = $retry_action;

		if ( $locked ) {
			$wpml_support_action = $this->notices->get_new_notice_action( __( 'WPML Support',
			                                                                  'wpml-translation-management' ),
			                                                              'https://wpml.org/forums/' );
			$wpml_support_action->set_link_target( '_blank' );

			$actions[] = $wpml_support_action;
		} else {
			$support_url = add_query_arg( array(
				                              'page' => WPML_PLUGIN_FOLDER . '/menu/support.php'
			                              ),
			                              admin_url( 'admin.php' ) ) . '#icl20-migration';

			$action    = $this->notices->get_new_notice_action( __( 'Error details',
			                                                        'wpml-translation-management' ),
			                                                    $support_url );
			$actions[] = $action;
		}

		$this->create_notice( $text, $actions );
	}

	private function build_migration_required() {
		$message = array();
		$actions                 = array();

		$link_pattern = '<a href="%1$s" target="_blank">%2$s</a>';
		$ask_us_link  = sprintf( $link_pattern,
		                         'https://wpml.org/forums/topic/im-not-sure-if-i-need-to-run-icanlocalize-migration/',
		                         esc_html__( 'Ask us', 'wpml-translation-management' ) );

		$user_confirmation_label = esc_html__( 'This is indeed my production site', 'wpml-translation-management' );

		$ajax_request_data = 'data-action="' . WPML_TM_ICL20_Migration_Support::PREFIX . 'user_confirm"';
		$ajax_request_data .= 'data-nonce="' . wp_create_nonce( WPML_TM_ICL20_Migration_Support::PREFIX
		                                                        . 'user_confirm' ) . '"';

		$user_confirmation_checkbox = '<input type="checkbox" value="1" id="wpml-icl20-migrate-confirm" '
		                              . $ajax_request_data
		                              . '>';
		$user_confirmation_checkbox .= '<label for="wpml-icl20-migrate-confirm">'
		                               . $user_confirmation_label
		                               . '</label>';

		$button_label = esc_html__( 'Start the update', 'wpml-translation-management' );

		$title = '<h3>WPML needs to update your ICanLocalize account settings</h3>';

		$message[] = esc_html__( 'WPML 3.9 changes the way it works with ICanLocalize. This requires WPML to move to a new interface with ICanLocalize.',
		                         'wpml-translation-management' );
		$message[] = esc_html__( 'If you are in a production site, you have to run this update before you can send more content for translation and receive completed translations.',
		                         'wpml-translation-management' );
		$message[] = esc_html__( "If this is not your production site (it's a staging or testing site), please do not run the update.",
		                         'wpml-translation-management' );
		$message[] = esc_html__( 'Running this update on a non-production site will make it impossible to correctly run it on the production site.',
		                         'wpml-translation-management' );
		$message[]    = '';
		$message[]    = sprintf( esc_html__( 'Not sure? %s.', 'wpml-translation-management' ), $ask_us_link );
		$message[]    = '';

		$message[] = $user_confirmation_checkbox;

		$text = $title . '<p>' . implode( '</p><p>', $message ) . '</p>';

		$start_action = $this->notices->get_new_notice_action( $button_label, '#', false, false, true );

		$actions[] = $start_action;

		$this->create_notice( $text, $actions );
	}

	private function create_notice( $text, array $actions = array() ) {
		$notice = $this->notices->create_notice( self::NOTICE_MIGRATION_REQUIRED_ID, $text, self::NOTICE_GROUP );

		$notice->set_css_class_types( array( 'error' ) );

		$notice->set_exclude_from_pages( array(
			                                 'sitepress-multilingual-cms/menu/support.php'
		                                 ) );

		foreach ( $actions as $action ) {
			$notice->add_action( $action );
		}

		$this->notices->add_notice( $notice );
	}

	private function build_migration_completed() {
		$message = array();

		$message[] = esc_html__( 'WPML updated your connection to ICanLocalize. You can continue sending content to translation.',
		                         'wpml-translation-management' );

		$text = '<p>' . implode( '</p><p>', $message ) . '</p>';

		$notice = $this->notices->create_notice( self::NOTICE_MIGRATION_COMPLETED_ID, $text, self::NOTICE_GROUP );
		$notice->set_css_class_types( array( 'warning' ) );
		$notice->set_exclude_from_pages( array(
			                                 'sitepress-multilingual-cms/menu/support.php'
		                                 ) );
		$notice->set_dismissible( true );

		$this->notices->add_notice( $notice );
	}

	public function admin_enqueue_scripts() {
		wp_enqueue_script( 'wpml-icl20-migrate-confirm',
		                   WPML_TM_URL . '/classes/ICL-20-migration/res/migration-required.js' );
	}
}