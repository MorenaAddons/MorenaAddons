<?php
namespace Elementor;

class Team_Member extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'team-members';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return '✨ Team Members ✨';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-person';
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
				'label' => __( 'Team Members', 'morena' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'teamMembersTitle',
			[
				'label' => __( 'Title', 'morena' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Team Members', 'morena' ),
				'placeholder' => __( 'Type your title here', 'morena' ),
			]
		);

		$this->add_control(
			'title_html_tag',
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

		$this->add_control(
			'slider_style',
			[
				'label' => __( 'Slider Style', 'morena' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'basic',
				'options' => [
					'royal'  => __( '👑 Royal', 'morena' ),
					'casual' => __( '👕 Casual', 'morena' ),
					'modern' => __( '🚀 Modern', 'morena' ),
					'styled' => __( '💄 Styled', 'morena' ),
					'basic' => __( 'Basic', 'morena' ),
				],
			]
		);
		 /** 
		  * Images for Team Members Grid
		  */



		$this->add_control(
			'teamMembersIcons',
			[
				'label' => __( 'Team Members', 'morena' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
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
 
		 <?php 
		$settings = $this->get_settings_for_display();

		// Title
		if(NULL != $settings['teamMembersTitle']){
			if(NULL != $settings['title_html_tag']){
				echo '<' . $settings['title_html_tag'] .'>' . $settings['teamMembersTitle'] . '</'. $settings['title_html_tag'] .'>';
			}
			else {
				echo 'Error: Title HTML Tag not set properly';
			}
		}

		// Slider type
		if(NULL != $settings['slider_style']){
			echo '<div class="morena-slider-'. $settings['slider_style']. '">';
		}

		// Slider with images
		if(NULL != $settings['teamMembersIcons']){
			foreach ( $settings['teamMembersIcons'] as $image ) {
				echo '<img src="' . $image['url'] . '">';
			}
		} 
		else 
		{
			echo 'Please select at least one image';
		}
		?>
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
		<{{{ settings.title_html_tag }}} class="teamMembersTitle">{{{ settings.teamMembersTitle }}}<{{{ settings.title_html_tag }}}>
        
		<div class="morena-slider-{{{ settings.slider_style }}}">
		<# _.each( settings.teamMembersIcons, function( image ) { #>
			<img src="{{ image.url }}" class="morena-slider-{{ settings.slider_style }}">
		<# }); #>
        </div>
		<?php
	}
}

    