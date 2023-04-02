<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_oEmbed_Widget extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return 'RSVP';
	}

	public function get_title()
	{
		return esc_html__('RSVP', 'elementor-oembed-widget');
	}

	public function get_icon()
	{
		return 'eicon-code';
	}

	public function get_custom_help_url()
	{
		return 'https://alivestori.com/';
	}

	public function get_categories()
	{
		return ['general'];
	}

	public function get_keywords()
	{
		return ['rsvp', 'kehadiran', 'chat'];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('RSVP Service Box', 'ds-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'card_style',
			[
				'label' => esc_html__('Select Style', 'ds-toolkit'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1' => __('Style One', 'ds-toolkit'),
					'2' => __('Style Two', 'ds-toolkit'),
				],
				'default' => '1',
			]
		);

		$this->end_controls_section();

		// Tab Style

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__('Style', 'textdomain'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background-box-color',
			[
				'label' => esc_html__('Backgroud Box Color', 'textdomain'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fdf4f9',
				'selectors' => [
					'{{WRAPPER}} .message-wish' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .message-wish .arrow-left' => 'border-right-color: {{VALUE}} !important',
				],
			]
		);

		//  Style Text Nama
		$this->add_control(
			'color-name',
			[
				'label' => esc_html__('Name Color', 'textdomain'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#00000',
				'selectors' => [
					'{{WRAPPER}} .nama' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'label' => __('Name Typography', 'textdomain'),
				'selector' => '{{WRAPPER}} .nama',
			]
		);

		//  Style Text Kehadiran
		$this->add_control(
			'kehadiran-color',
			[
				'label' => esc_html__('Kehadiran Color', 'textdomain'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#00000',
				'selectors' => [
					'{{WRAPPER}} .kehadiran' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background-kehadiran-color',
			[
				'label' => esc_html__('Kehadiran Backgroud Color', 'textdomain'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'Gray',
				'selectors' => [
					'{{WRAPPER}} .kehadiran' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'kehadiran_typography',
				'label' => __('Kehadiran Typography', 'textdomain'),
				'selector' => '{{WRAPPER}} .kehadiran',
			]
		);

		//  Style Text Pesan
		$this->add_control(
			'pesan-color',
			[
				'label' => esc_html__('Comment Color', 'textdomain'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#00000',
				'selectors' => [
					'{{WRAPPER}} .pesan' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pesan_typography',
				'label' => __('Comment Typography', 'textdomain'),
				'selector' => '{{WRAPPER}} .pesan',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		wp_enqueue_style('bootstrap_5');
		wp_enqueue_script('bootstrap_5');

		if ($settings['card_style'] == '1'): ?>
			<?php $post_id = get_the_ID(); ?>
			<?php $data_rsvp = get_all_rsvp_by_postid($post_id); ?>
			<?php foreach ($data_rsvp as $data): ?>
				<div class="container">
					<div class="mb-3">
						<div class="rsvp row flex-nowrap">
							<div class="col-1 text-center pt-2">
								<img src="<?php bloginfo("url"); ?>/wp-content/plugins/DS_plugin/assets/comment.png" alt="Cinque Terre"
									class="d-inline">
							</div>

							<div class="message-wish col-11 p-3 shadow-sm position-relative" style="border-radius: 16px;">
								<div class="arrow-left" style="
									border-right:7px solid;
									width: 0;
									height: 0;
									border-top: 7px solid transparent;
									border-bottom: 7px solid transparent;
									position: absolute;
									left: -6px;
									top: 16px;
								"></div>
								<div class="d-flex flex-row align-items-center">
									<div class="nama">
										<?= $data["nama"] ?>
									</div>
									<div class="kehadiran ms-2" style="padding: 4px 16px; border-radius: 6px;">
										<?= $data["kehadiran"] ?>
									</div>
								</div>
								<div class="pesan mt-2">
									<?= $data["ucapan"] ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach;
		endif; ?>
		<?php if ($settings['card_style'] == '2'): ?>
			<h1>Comming Soon GESSSS....</h1>
		<?php endif;
	}
}