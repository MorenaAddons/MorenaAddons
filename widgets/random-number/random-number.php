<?php
namespace Elementor;

class Random_Number extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'random-number';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return '✨ Random Number ✨';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-number-field';
	}

	/**
	 * Get widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'basic' ];
	}

	/**
	 * Register widget controls.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		/**
		 *  Here you can add your controls. The controls below are only examples.
		 *  Check this: https://developers.elementor.com/elementor-controls/
		 *
		 **/

		 /**
		  * Text field for Grid Title
		  */

		  $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Random number', 'morena' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'teamMembersTitle',
			[
				'label' => __( 'Title', 'morena' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Random number', 'morena' ),
				'placeholder' => __( 'Type your number 0-2 here', 'morena' ),
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label' => __( 'Title HTML tag', 'morena' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'span',
				'options' => [
					'span'  => __( 'span', 'morena' ),
					'p' => __( 'p', 'morena' ),
					'h1' => __( 'h1', 'morena' ),
					'h2' => __( 'h2', 'morena' ),
					'h3' => __( 'h3', 'morena' ),
					'h4' => __( 'h4', 'morena' ),
					'h5' => __( 'h5', 'morena' ),
					'div' => __( 'div', 'morena' ),
				],
			]
		);

	
		/**
		 * Information about refreshing
		 */
		$this->add_control(
			'important_note',
			[
				'label' => __( '❗ Important Note ❗', 'morena' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<br>Save and refresh editor when you change something.', 'morena' ),
				'content_classes' => 'your-class',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		/**
		 *  Here you can output your control data and build your content.
		 **/

 ?>
		<!-- Here you can add your custom HTML output.
		You can use all field variables you created above. -->

        <div>
 
		<!-- HTML Here -->
		</div>
        </div>
 <?php

	}

	/**
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 * With JS templates we don’t really need to retrieve the data using a special function, its done by Elementor for us.
	 * The data from the controls stored in the settings variable.
	 */
	protected function _content_template() {
		?>
		<!-- Here you can add your custom HTML output.
		You can use all field variables you created above. -->
		<div>
			<span>Random number</span>
        </div>
		<?php
	}
}

    