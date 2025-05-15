<?php
if (!defined('ABSPATH')) {
  exit;
}

class Elementor_Slide_Widget extends \Elementor\Widget_Base
{
  public function __construct($data = [], $args = null)
  {
    parent::__construct($data, $args);
    add_action('elementor/editor/after_enqueue_styles', [$this, 'editor_styles']);
  }

  public function editor_styles()
  {
    echo '
    <style>
        /* Hide only the "Add Desc" button */
        .elementor-control-description_items .elementor-repeater-add {
            display: none !important;
        }
        
    </style>
    ';
  }

  public function get_name()
  {
    return 'custom-splide-slider';
  }

  public function get_title()
  {
    return __('Splide Slider', 'custom-slide-widget');
  }

  public function get_icon()
  {
    return 'eicon-slider-device';
  }

  public function get_categories()
  {
    return ['general'];
  }

  protected function register_controls()
  {

    $this->register_content_controls();
    $this->register_setting_controls();
    $this->register_overlay_settings_controls();
    $this->register_title_style_controls();
    $this->register_image_style_controls();
    $this->register_content_style_controls();
    $this->register_description_style_controls();
    $this->register_navigation_style_controls();
    $this->register_pagination_style_controls();
    $this->register_button_style_controls();
  }


  protected function register_content_controls()
  {
    $this->start_controls_section(
      'content_section',
      [
        'label' => __('Slider Content', 'custom-slide-widget'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
      'slide_image',
      [
        'label' => __('Choose Image', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
          'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
      ]
    );

    $repeater->add_control(
      'slide_title',
      [
        'label' => __('Title', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Slide Title', 'custom-slide-widget'),
        'label_block' => true,
      ]
    );

    $repeater->add_control(
      'slide_description',
      [
        'label' => __('Description', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => __('Slide description goes here', 'custom-slide-widget'),
      ]
    );

    $repeater->add_control(
      'slide_primary_link_text',
      [
        'label' => __('Primary Link Text', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'Learn More',
      ]
    );
    $repeater->add_control(
      'slide_primary_link',
      [
        'label' => __('Primary Link', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::URL,
      ]
    );
    $repeater->add_control(
      'slide_secondary_link_text',
      [
        'label' => __('Secondary Link Text', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'Back',
      ]
    );
    $repeater->add_control(
      'slide_secondary_link',
      [
        'label' => __('Secondary Link', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::URL,
      ]
    );


    $repeater->add_control(
      'descriptions',
      [
        'label' => __('Descriptions', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => '',
        'description' => __('Add multiple descriptions separated by new lines. Alternate lines become heading and text.'),
        'label_block' => true,
      ]
    );

    $this->add_control(
      'slides',
      [
        'label' => __('Slides', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
          [
            'slide_title' => __('Slide 1', 'custom-slide-widget'),
            'slide_description' => __('First slide description', 'custom-slide-widget'),
            'descriptions' => __('First slide descriptions', 'custom-slide-widget'),
          ],
          [
            'slide_title' => __('Slide 2', 'custom-slide-widget'),
            'slide_description' => __('Second slide description', 'custom-slide-widget'),
            'descriptions' => __('Second slide descriptions', 'custom-slide-widget'),
          ],
        ],
        'title_field' => '{{{ slide_title }}}',
      ]
    );

    $this->add_control(
      'image_type',
      [
        'label' => __('Image Display Type', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'img' => __('Regular Image Tag', 'custom-slide-widget'),
          'bg' => __('Background Image', 'custom-slide-widget'),
        ],
        'default' => 'img',
        'separator' => 'before',
      ]
    );


    $this->end_controls_section();
  }
  protected function register_setting_controls()
  {
    $this->start_controls_section(
      'settings_section',
      [
        'label' => __('Slider Settings', 'custom-slide-widget'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'autoplay',
      [
        'label' => __('Autoplay', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'custom-slide-widget'),
        'label_off' => __('No', 'custom-slide-widget'),
        'return_value' => 'yes',
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'pauseOnHover',
      [
        'label' => __('PauseOnHover', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'custom-slide-widget'),
        'label_off' => __('No', 'custom-slide-widget'),
        'return_value' => 'yes',
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'autoplay_speed',
      [
        'label' => __('Autoplay Speed (ms)', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 3000,
        'condition' => [
          'autoplay' => 'yes',
        ],
      ]
    );

    $this->add_control(
      'loop',
      [
        'label' => __('Infinite Loop', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'custom-slide-widget'),
        'label_off' => __('No', 'custom-slide-widget'),
        'return_value' => 'yes',
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'show_arrows',
      [
        'label' => __('Show Arrows', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Show', 'custom-slide-widget'),
        'label_off' => __('Hide', 'custom-slide-widget'),
        'return_value' => 'yes',
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'show_dots',
      [
        'label' => __('Show Dots', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Show', 'custom-slide-widget'),
        'label_off' => __('Hide', 'custom-slide-widget'),
        'return_value' => 'yes',
        'default' => 'yes',
      ]
    );

    // $this->add_control(
    //   'perPage',
    //   [
    //     'label' => __('Per Page Slide Num', 'custom-slide-widget'),
    //     'type' => \Elementor\Controls_Manager::NUMBER,
    //     'default' => 1,
    //   ]
    // );

    // $this->add_control(
    //   'perMove',
    //   [
    //     'label' => __('Per Move Slide Num', 'custom-slide-widget'),
    //     'type' => \Elementor\Controls_Manager::NUMBER,
    //   ]
    // );

    // Icon Controls
    $this->add_control(
      'arrow_icon_heading',
      [
        'label' => __('Arrow Icons', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'show_arrows' => 'yes',
        ],
      ]
    );
    $this->start_controls_tabs('tabs_navigation_icons');
    $this->start_controls_tab(
      'tab_prev_navigation_icon',
      [
        'label' => __('Prev Icon', 'custom-slide-widget'),
      ],
    );
    $this->add_control(
      'prev_icon',
      [
        'label' => __('Previous Icon', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
          'value' => 'fas fa-chevron-left',
          'library' => 'fa-solid',
        ],
        'condition' => [
          'show_arrows' => 'yes',
        ],
      ]
    );
    $this->add_control(
      'custom_prev_icon_svg',
      [
        'label' => __('Custom SVG Code', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'description' => __('Paste SVG code for both arrows (will override icon selection)', 'custom-slide-widget'),
        'condition' => [
          'show_arrows' => 'yes',
        ],
      ]
    );
    $this->end_controls_tab();
    $this->start_controls_tab(
      'tab_next_navigation_icon',
      [
        'label' => __('Next Icon', 'custom-slide-widget'),
      ],
    );

    $this->add_control(
      'next_icon',
      [
        'label' => __('Next Icon', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
          'value' => 'fas fa-chevron-right',
          'library' => 'fa-solid',
        ],
        'condition' => [
          'show_arrows' => 'yes',
        ],
      ]
    );

    $this->add_control(
      'custom_next_icon_svg',
      [
        'label' => __('Custom SVG Code', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'description' => __('Paste SVG code for both arrows (will override icon selection)', 'custom-slide-widget'),
        'condition' => [
          'show_arrows' => 'yes',
        ],
      ]
    );
    $this->end_controls_tab();

    $this->end_controls_tabs();

    $this->end_controls_section();
  }
  protected function register_overlay_settings_controls()
  {
    $this->start_controls_section(
      'overlay_section',
      [
        'label' => __('Slide Overlay', 'custom-slide-widget'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'show_overlay',
      [
        'label' => __('Show Overlay', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Show', 'custom-slide-widget'),
        'label_off' => __('Hide', 'custom-slide-widget'),
        'return_value' => 'yes',
        'default' => 'no',
      ]
    );

    $this->add_control(
      'overlay_type',
      [
        'label' => __('Overlay Type', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'color' => __('Color', 'custom-slide-widget'),
          'gradient' => __('Gradient', 'custom-slide-widget'),
        ],
        'default' => 'color',
        'condition' => [
          'show_overlay' => 'yes',
        ],
      ]
    );

    $this->add_control(
      'overlay_color',
      [
        'label' => __('Overlay Color', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .splide-slide-overlay' => 'background-color: {{VALUE}}',
        ],
        'condition' => [
          'show_overlay' => 'yes',
          'overlay_type' => 'color',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name' => 'overlay_gradient',
        'label' => __('Overlay Gradient', 'custom-slide-widget'),
        'types' => ['gradient'],
        'selector' => '{{WRAPPER}} .splide-slide-overlay',
        'condition' => [
          'show_overlay' => 'yes',
          'overlay_type' => 'gradient',
        ],
      ]
    );

    $this->add_control(
      'overlay_opacity',
      [
        'label' => __('Overlay Opacity', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'max' => 1,
            'min' => 0,
            'step' => 0.01,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-overlay' => 'opacity: {{SIZE}};',
        ],
        'condition' => [
          'show_overlay' => 'yes',
        ],
      ]
    );

    $this->add_control(
      'overlay_blend_mode',
      [
        'label' => __('Blend Mode', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          '' => __('Normal', 'custom-slide-widget'),
          'multiply' => __('Multiply', 'custom-slide-widget'),
          'screen' => __('Screen', 'custom-slide-widget'),
          'overlay' => __('Overlay', 'custom-slide-widget'),
          'darken' => __('Darken', 'custom-slide-widget'),
          'lighten' => __('Lighten', 'custom-slide-widget'),
          'color-dodge' => __('Color Dodge', 'custom-slide-widget'),
          'color-burn' => __('Color Burn', 'custom-slide-widget'),
          'difference' => __('Difference', 'custom-slide-widget'),
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-overlay' => 'mix-blend-mode: {{VALUE}}',
        ],
        'condition' => [
          'show_overlay' => 'yes',
        ],
      ]
    );

    $this->add_responsive_control(
      'overlay_margin',
      [
        'label' => __('Margin', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%'],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-overlay' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'condition' => [
          'show_overlay' => 'yes',
        ],
      ]
    );

    $this->add_control(
      'overlay_zindex',
      [
        'label' => __('Z-Index', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => 0,
        'max' => 9999,
        'step' => 1,
        'default' => 2,
        'selectors' => [
          '{{WRAPPER}} .splide-slide-overlay' => 'z-index: {{VALUE}};',
        ],
        'condition' => [
          'show_overlay' => 'yes',
        ],
      ]
    );

    $this->end_controls_section();
  }
  protected function register_title_style_controls()
  {
    $this->start_controls_section(
      'title_style_section',
      [
        'label' => __('Title Style', 'custom-slide-widget'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'splide_slide_title_typography',
        'label' => __('Typography', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .splide-slide-title',
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Text_Stroke::get_type(),
      [
        'name' => 'splide_slide_title_text_color',
        'label' => __('Text Color', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .splide-slide-title',
      ]
    );
    $this->add_responsive_control(
      'slide_title_margin',
      [
        'label' => __('Margin', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'rem'],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
        ],
      ],
    );

    $this->add_responsive_control(
      'slide_title_padding',
      [
        'label' => __('Padding', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'rem'],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
        ],
      ],
    );
    $this->add_control(
      'splide_slide_description_heading',
      [
        'label' => __('Splide Slide Description', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'button_typography', // Used internally
        'label' => __('Typography', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .splide-slide-description',
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Text_Stroke::get_type(),
      [
        'name' => 'splide_slide_description_typography', // Used internally
        'label' => __('Text Color', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .splide-slide-description',
      ]
    );

    $this->add_responsive_control(
      'splide_slide_description_margin',
      [
        'label' => __('Margin', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'rem'],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
        ],
      ],
    );

    $this->add_responsive_control(
      'splide_slide_description_padding',
      [
        'label' => __('Padding', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'rem'],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
        ],
      ],
    );

    $this->end_controls_section();
  }
  protected function register_image_style_controls()
  {
    $this->start_controls_section(
      'image_style_section',
      [
        'label' => __('Image Style', 'custom-slide-widget'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    // Size Controls
    $this->add_responsive_control(
      'image_width',
      [
        'label' => __('Width', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vw'],
        'range' => [
          'px' => ['min' => 0, 'max' => 2000],
          '%' => ['min' => 0, 'max' => 100],
          'vw' => ['min' => 0, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image' => 'width: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .splide-slide-image-bg' => 'width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'image_height',
      [
        'label' => __('Height', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'vh'],
        'range' => [
          'px' => ['min' => 0, 'max' => 2000],
          '%' => ['min' => 0, 'max' => 100],
          'vh' => ['min' => 0, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image' => 'height: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .splide-slide-image-bg' => 'height: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'image_min_width',
      [
        'label' => __('Min Width', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vw'],
        'range' => [
          'px' => ['min' => 0, 'max' => 2000],
          '%' => ['min' => 0, 'max' => 100],
          'vw' => ['min' => 0, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image' => 'min-width: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .splide-slide-image-bg' => 'min-width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'image_min_height',
      [
        'label' => __('Min Height', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'vh'],
        'range' => [
          'px' => ['min' => 0, 'max' => 2000],
          'vh' => ['min' => 0, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image' => 'min-height: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .splide-slide-image-bg' => 'min-height: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'image_max_width',
      [
        'label' => __('Max Width', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vw'],
        'range' => [
          'px' => ['min' => 0, 'max' => 2000],
          '%' => ['min' => 0, 'max' => 100],
          'vw' => ['min' => 0, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image' => 'max-width: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .splide-slide-image-bg' => 'max-width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'image_max_height',
      [
        'label' => __('Max Height', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'vh'],
        'range' => [
          'px' => ['min' => 0, 'max' => 2000],
          'vh' => ['min' => 0, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image' => 'max-height: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .splide-slide-image-bg' => 'max-height: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    // Position Controls
    $this->add_control(
      'image_position',
      [
        'label' => __('Position', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          '' => __('Default', 'custom-slide-widget'),
          'absolute' => __('Absolute', 'custom-slide-widget'),
          'relative' => __('Relative', 'custom-slide-widget'),
          'fixed' => __('Fixed', 'custom-slide-widget'),
        ],
        'default' => '',
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image' => 'position: {{VALUE}};',
          '{{WRAPPER}} .splide-slide-image-bg' => 'position: {{VALUE}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'image_zindex',
      [
        'label' => __('Z-Index', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => -100,
        'max' => 1000,
        'step' => 1,
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image' => 'z-index: {{VALUE}};',
          '{{WRAPPER}} .splide-slide-image-bg' => 'z-index: {{VALUE}};',
        ],
      ]
    );

    // Position Coordinates
    $this->add_responsive_control(
      'image_top',
      [
        'label' => __('Top', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vh'],
        'range' => [
          'px' => ['min' => -500, 'max' => 500],
          '%' => ['min' => -100, 'max' => 100],
          'vh' => ['min' => -100, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image' => 'top: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .splide-slide-image-bg' => 'top: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [
          'image_position' => ['absolute', 'fixed', 'relative'],
        ],
      ]
    );

    $this->add_responsive_control(
      'image_right',
      [
        'label' => __('Right', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vh'],
        'range' => [
          'px' => ['min' => -500, 'max' => 500],
          '%' => ['min' => -100, 'max' => 100],
          'vh' => ['min' => -100, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image' => 'right: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .splide-slide-image-bg' => 'right: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [
          'image_position' => ['absolute', 'fixed', 'relative'],
        ],
      ]
    );

    $this->add_responsive_control(
      'image_bottom',
      [
        'label' => __('Bottom', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vh'],
        'range' => [
          'px' => ['min' => -500, 'max' => 500],
          '%' => ['min' => -100, 'max' => 100],
          'vh' => ['min' => -100, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image' => 'bottom: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .splide-slide-image-bg' => 'bottom: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [
          'image_position' => ['absolute', 'fixed', 'relative'],
        ],
      ]
    );

    $this->add_responsive_control(
      'image_left',
      [
        'label' => __('Left', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vh'],
        'range' => [
          'px' => ['min' => -500, 'max' => 500],
          '%' => ['min' => -100, 'max' => 100],
          'vh' => ['min' => -100, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image' => 'left: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .splide-slide-image-bg' => 'left: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [
          'image_position' => ['absolute', 'fixed', 'relative'],
        ],
      ]
    );

    // Spacing
    $this->add_responsive_control(
      'image_padding',
      [
        'label' => __('Padding', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          '{{WRAPPER}} .splide-slide-image-bg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'image_margin',
      [
        'label' => __('Margin', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          '{{WRAPPER}} .splide-slide-image-bg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    // Background Image Specific
    $this->add_control(
      'bg_image_size',
      [
        'label' => __('Background Size', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'cover' => __('Cover', 'custom-slide-widget'),
          'contain' => __('Contain', 'custom-slide-widget'),
          'auto' => __('Auto', 'custom-slide-widget'),
        ],
        'default' => 'cover',
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image-bg' => 'background-size: {{VALUE}};',
        ],
        'condition' => [
          'image_type' => 'bg',
        ],
      ]
    );

    $this->add_control(
      'bg_image_position',
      [
        'label' => __('Background Position', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'center center' => __('Center Center', 'custom-slide-widget'),
          'center left' => __('Center Left', 'custom-slide-widget'),
          'center right' => __('Center Right', 'custom-slide-widget'),
          'top center' => __('Top Center', 'custom-slide-widget'),
          'top left' => __('Top Left', 'custom-slide-widget'),
          'top right' => __('Top Right', 'custom-slide-widget'),
          'bottom center' => __('Bottom Center', 'custom-slide-widget'),
          'bottom left' => __('Bottom Left', 'custom-slide-widget'),
          'bottom right' => __('Bottom Right', 'custom-slide-widget'),
        ],
        'default' => 'center center',
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image-bg' => 'background-position: {{VALUE}};',
        ],
        'condition' => [
          'image_type' => 'bg',
        ],
      ]
    );

    $this->add_control(
      'bg_image_repeat',
      [
        'label' => __('Background Repeat', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'no-repeat' => __('No Repeat', 'custom-slide-widget'),
          'repeat' => __('Repeat', 'custom-slide-widget'),
          'repeat-x' => __('Repeat X', 'custom-slide-widget'),
          'repeat-y' => __('Repeat Y', 'custom-slide-widget'),
        ],
        'default' => 'no-repeat',
        'selectors' => [
          '{{WRAPPER}} .splide-slide-image-bg' => 'background-repeat: {{VALUE}};',
        ],
        'condition' => [
          'image_type' => 'bg',
        ],
      ]
    );

    $this->end_controls_section();
  }
  protected function register_content_style_controls()
  {
    $this->start_controls_section(
      'slide_content_style',
      [
        'label' => __('Slide Content', 'custom-slide-widget'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'pauseOnHover',
      [
        'label' => __('PauseOnHover', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'custom-slide-widget'),
        'label_off' => __('No', 'custom-slide-widget'),
        'return_value' => 'yes',
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'content_container_width',
      [
        'label' => __('Layout', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'boxed' => __('Boxed', 'custom-slide-widget'),
          'full-width' => __('Full Width', 'custom-slide-widget'),
        ],
        'default' => 'boxed',
      ]
    );

    // Layout Control
    $this->add_control(
      'content_layout',
      [
        'label' => __('Layout', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'block' => __('Block', 'custom-slide-widget'),
          'flex' => __('Flex', 'custom-slide-widget'),
          'grid' => __('Grid', 'custom-slide-widget'),
        ],
        'default' => 'block',
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'display: {{VALUE}};',
        ],
      ]
    );

    // Sizing Controls
    $this->add_responsive_control(
      'content_width',
      [
        'label' => __('Width', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vw'],
        'range' => [
          'px' => ['min' => 0, 'max' => 2000],
          '%' => ['min' => 0, 'max' => 100],
          'vw' => ['min' => 0, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'content_max_width',
      [
        'label' => __('Max Width', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vw'],
        'range' => [
          'px' => ['min' => 0, 'max' => 2000],
          '%' => ['min' => 0, 'max' => 100],
          'vw' => ['min' => 0, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'max-width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'content_height',
      [
        'label' => __('Height', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'vh', 'svh'],
        'range' => [
          'px' => ['min' => 0, 'max' => 2000],
          'vh' => ['min' => 0, 'max' => 100],
          'svh' => ['min' => 0, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'height: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'content_min_height',
      [
        'label' => __('Min Height', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'vh'],
        'range' => [
          'px' => ['min' => 0, 'max' => 2000],
          'vh' => ['min' => 0, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'min-height: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    // Spacing
    $this->add_responsive_control(
      'content_padding',
      [
        'label' => __('Padding', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'content_margin',
      [
        'label' => __('Margin', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    // Flex Options
    $this->add_control(
      'flex_direction',
      [
        'label' => __('Flex Direction', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'row' => __('Row', 'custom-slide-widget'),
          'column' => __('Column', 'custom-slide-widget'),
          'row-reverse' => __('Row Reverse', 'custom-slide-widget'),
          'column-reverse' => __('Column Reverse', 'custom-slide-widget'),
        ],
        'default' => 'column',
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'flex-direction: {{VALUE}};',
        ],
        'condition' => [
          'content_layout' => 'flex',
        ],
      ]
    );

    $this->add_responsive_control(
      'align_items',
      [
        'label' => __('Align Items', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'flex-start' => __('Start', 'custom-slide-widget'),
          'flex-end' => __('End', 'custom-slide-widget'),
          'center' => __('Center', 'custom-slide-widget'),
          'baseline' => __('Baseline', 'custom-slide-widget'),
          'stretch' => __('Stretch', 'custom-slide-widget'),
        ],
        'default' => 'center',
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'align-items: {{VALUE}};',
        ],
        'condition' => [
          'content_layout' => 'flex',
        ],
      ]
    );

    $this->add_responsive_control(
      'justify_content',
      [
        'label' => __('Justify Content', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'flex-start' => __('Start', 'custom-slide-widget'),
          'flex-end' => __('End', 'custom-slide-widget'),
          'center' => __('Center', 'custom-slide-widget'),
          'space-between' => __('Space Between', 'custom-slide-widget'),
          'space-around' => __('Space Around', 'custom-slide-widget'),
          'space-evenly' => __('Space Evenly', 'custom-slide-widget'),
        ],
        'default' => 'center',
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'justify-content: {{VALUE}};',
        ],
        'condition' => [
          'content_layout' => 'flex',
        ],
      ]
    );

    // Grid Options
    $this->add_responsive_control(
      'grid_columns',
      [
        'label' => __('Grid Columns', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => 1,
        'max' => 12,
        'step' => 1,
        'default' => 1,
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
        ],
        'condition' => [
          'content_layout' => 'grid',
        ],
      ]
    );

    // Position
    $this->add_control(
      'content_position',
      [
        'label' => __('Position', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          '' => __('Default', 'custom-slide-widget'),
          'absolute' => __('Absolute', 'custom-slide-widget'),
          'fixed' => __('Fixed', 'custom-slide-widget'),
          'relative' => __('Relative', 'custom-slide-widget'),
          'sticky' => __('Sticky', 'custom-slide-widget'),
        ],
        'default' => '',
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'position: {{VALUE}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'content_top',
      [
        'label' => __('Top', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vh'],
        'range' => [
          'px' => ['min' => -500, 'max' => 500],
          '%' => ['min' => -100, 'max' => 100],
          'vh' => ['min' => -100, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'top: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [
          'content_position' => ['absolute', 'fixed', 'relative', 'sticky'],
        ],
      ]
    );
    $this->add_responsive_control(
      'content_bottom',
      [
        'label' => __('Bottom', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vh'],
        'range' => [
          'px' => ['min' => -500, 'max' => 500],
          '%' => ['min' => -100, 'max' => 100],
          'vh' => ['min' => -100, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'bottom: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [
          'content_position' => ['absolute', 'fixed', 'relative', 'sticky'],
        ],
      ]
    );
    $this->add_responsive_control(
      'content_left',
      [
        'label' => __('Left', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vh'],
        'range' => [
          'px' => ['min' => -500, 'max' => 500],
          '%' => ['min' => -100, 'max' => 100],
          'vh' => ['min' => -100, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'left: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [
          'content_position' => ['absolute', 'fixed', 'relative', 'sticky'],
        ],
      ]
    );
    $this->add_responsive_control(
      'content_right',
      [
        'label' => __('Right', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vh'],
        'range' => [
          'px' => ['min' => -500, 'max' => 500],
          '%' => ['min' => -100, 'max' => 100],
          'vh' => ['min' => -100, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'right: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [
          'content_position' => ['absolute', 'fixed', 'relative', 'sticky'],
        ],
      ]
    );

    $this->add_control(
      'content_zindex',
      [
        'label' => __('Z-Index', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => 0,
        'max' => 9999,
        'step' => 1,
        'default' => 1,
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'z-index: {{VALUE}};',
        ],
        'condition' => [
          'content_position' => 'absolute',
          'content_position' => 'relative',
        ],
      ]
    );

    // Background
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name' => 'content_background',
        'label' => __('Background', 'custom-slide-widget'),
        'types' => ['classic', 'gradient'],
        'selector' => '{{WRAPPER}} .splide-slide-content',
      ]
    );

    // Border
    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'content_border',
        'label' => __('Border', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .splide-slide-content',
      ]
    );

    $this->add_control(
      'content_border_radius',
      [
        'label' => __('Border Radius', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%'],
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    // Text Color
    $this->add_control(
      'content_text_color',
      [
        'label' => __('Text Color', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .splide-slide-content' => 'color: {{VALUE}};',
          '{{WRAPPER}} .splide-slide-content a' => 'color: {{VALUE}};',
        ],
      ]
    );

    // Box Shadow
    $this->add_group_control(
      \Elementor\Group_Control_Box_Shadow::get_type(),
      [
        'name' => 'content_box_shadow',
        'label' => __('Box Shadow', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .splide-slide-content',
      ]
    );

    $this->end_controls_section();
  }
  protected function register_description_style_controls()
  {
    $this->start_controls_section(
      'description_container_style',
      [
        'label' => __('Description Container', 'custom-slide-widget'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    // Layout control
    $this->add_control(
      'desc_container_layout',
      [
        'label' => __('Layout', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'block' => __('Block', 'custom-slide-widget'),
          'flex' => __('Flex', 'custom-slide-widget'),
          'grid' => __('Grid', 'custom-slide-widget'),
        ],
        'default' => 'flex',
        'selectors' => [
          '{{WRAPPER}} .description-container' => 'display: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'desc_container_flex_wrap',
      [
        'label' => __('Flex Wrap', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'custom-slide-widget'),
        'label_off' => __('No', 'custom-slide-widget'),
        'return_value' => 'wrap',
        'default' => 'wrap',
        'selectors' => [
          '{{WRAPPER}} .description-container' => 'flex-wrap: {{VALUE}};'
        ],
        'condition' => [
          'desc_container_layout' => 'flex',
        ],
      ],
    );

    // Add flex-specific controls
    $this->add_control(
      'desc_flex_direction',
      [
        'label' => __('Flex Direction', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'row' => __('Row', 'custom-slide-widget'),
          'column' => __('Column', 'custom-slide-widget'),
          'row-reverse' => __('Row Reverse', 'custom-slide-widget'),
          'column-reverse' => __('Column Reverse', 'custom-slide-widget'),
        ],
        'default' => 'row',
        'selectors' => [
          '{{WRAPPER}} .description-container' => 'flex-direction: {{VALUE}};',
        ],
        'condition' => [
          'desc_container_layout' => 'flex',
        ],
      ]
    );

    // Add grid-specific controls
    $this->add_responsive_control(
      'desc_grid_columns',
      [
        'label' => __('Grid Columns', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => 1,
        'max' => 12,
        'step' => 1,
        'default' => 1,
        'selectors' => [
          '{{WRAPPER}} .description-container' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
        ],
        'condition' => [
          'desc_container_layout' => 'grid',
        ],
      ]
    );

    // Add gap control for flex/grid layouts
    $this->add_responsive_control(
      'desc_gap',
      [
        'label' => __('Gap', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .description-container' => 'gap: {{SIZE}}{{UNIT}};',
        ],
        'conditions' => [
          'relation' => 'or',
          'terms' => [
            [
              'name' => 'desc_container_layout',
              'operator' => '===',
              'value' => 'flex'
            ],
            [
              'name' => 'desc_container_layout',
              'operator' => '===',
              'value' => 'grid'
            ]
          ]
        ],
      ]
    );

    // Common styling controls
    $this->add_responsive_control(
      'desc_container_padding',
      [
        'label' => __('Padding', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
          '{{WRAPPER}} .description-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    // Common styling controls
    $this->add_responsive_control(
      'desc_container_margin',
      [
        'label' => __('Margin', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
          '{{WRAPPER}} .description-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    $this->add_control(
      'desc_heading_style',
      [
        'label' => __('Desc Sub Heading', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'desc_heading_typography', // Used internally
        'label' => __('Typography Desc Heading', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .description-heading',

      ]
    );
    $this->add_control(
      'desc_text_style',
      [
        'label' => __('Description Text', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'desc_text_typography', // Used internally
        'label' => __('Typography Desc Text', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .description-text',

      ]
    );
    $this->end_controls_section();
  }
  protected function register_navigation_style_controls()
  {
    $this->start_controls_section(
      'arrow_style_section',
      [
        'label' => __('Navigation Arrows', 'custom-slide-widget'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        'condition' => [
          'show_arrows' => 'yes',
        ],
      ]
    );



    $this->add_responsive_control(
      'arrows_display',
      [
        'label' => __('Arrows Display', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'block' => __('Block', 'custom-slide-widget'),
          'none' => __('None', 'custom-slide-widget'),
        ],
        'default' => '',
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'display: {{VALUE}};',
        ],
      ]
    );

    // Arrow container styles
    $this->add_responsive_control(
      'arrow_size',
      [
        'label' => __('Size', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
          'px' => [
            'min' => 10,
            'max' => 200,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'arrow_padding',
      [
        'label' => __('Padding', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%'],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'arrow_margin',
      [
        'label' => __('Margin', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%'],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'arrow_display',
      [
        'label' => __('Display', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'flex',
        'options' => [
          'flex' => __('Flex', 'custom-slide-widget'),
          'inline-flex' => __('Inline Flex', 'custom-slide-widget'),
          'block' => __('Block', 'custom-slide-widget'),
          'inline-block' => __('Inline Block', 'custom-slide-widget'),
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'display: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'arrow_align_items',
      [
        'label' => __('Align Items', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'center',
        'options' => [
          'flex-start' => __('Start', 'custom-slide-widget'),
          'flex-end' => __('End', 'custom-slide-widget'),
          'center' => __('Center', 'custom-slide-widget'),
          'baseline' => __('Baseline', 'custom-slide-widget'),
          'stretch' => __('Stretch', 'custom-slide-widget'),
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'align-items: {{VALUE}};',
        ],
        'condition' => [
          'arrow_display' => ['flex', 'inline-flex'],
        ],
      ]
    );

    $this->add_control(
      'arrow_justify_content',
      [
        'label' => __('Justify Content', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'center',
        'options' => [
          'flex-start' => __('Start', 'custom-slide-widget'),
          'flex-end' => __('End', 'custom-slide-widget'),
          'center' => __('Center', 'custom-slide-widget'),
          'space-between' => __('Space Between', 'custom-slide-widget'),
          'space-around' => __('Space Around', 'custom-slide-widget'),
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'justify-content: {{VALUE}};',
        ],
        'condition' => [
          'arrow_display' => ['flex', 'inline-flex'],
        ],
      ]
    );

    // Arrow position
    $this->add_control(
      'arrow_position',
      [
        'label' => __('Position', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'absolute',
        'options' => [
          'absolute' => __('Absolute', 'custom-slide-widget'),
          'relative' => __('Relative', 'custom-slide-widget'),
          'fixed' => __('Fixed', 'custom-slide-widget'),
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'position: {{VALUE}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'arrow_left',
      [
        'label' => __('Left Position', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'range' => [
          'px' => [
            'min' => -200,
            'max' => 200,
          ],
          '%' => [
            'min' => -100,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow--prev' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
        ],
        'condition' => [
          'arrow_position' => ['absolute', 'fixed'],
        ],
      ]
    );

    $this->add_responsive_control(
      'arrow_right',
      [
        'label' => __('Right Position', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'range' => [
          'px' => [
            'min' => -200,
            'max' => 200,
          ],
          '%' => [
            'min' => -100,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow--next' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
        ],
        'condition' => [
          'arrow_position' => ['absolute', 'fixed'],
        ],
      ]
    );

    $this->add_responsive_control(
      'arrow_top',
      [
        'label' => __('Top Position', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'range' => [
          'px' => [
            'min' => -200,
            'max' => 200,
          ],
          '%' => [
            'min' => -100,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'top: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [
          'arrow_position' => ['absolute', 'fixed'],
        ],
      ]
    );

    $this->add_responsive_control(
      'arrow_bottom',
      [
        'label' => __('Bottom Position', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'range' => [
          'px' => [
            'min' => -200,
            'max' => 200,
          ],
          '%' => [
            'min' => -100,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'bottom: {{SIZE}}{{UNIT}}; top: auto;',
        ],
        'condition' => [
          'arrow_position' => ['absolute', 'fixed'],
        ],
      ]
    );

    $this->add_control(
      'arrow_zindex',
      [
        'label' => __('Z-Index', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => 0,
        'max' => 9999,
        'step' => 1,
        'default' => 10,
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'z-index: {{VALUE}};',
        ],
      ]
    );

    // Arrow background
    $this->add_control(
      'arrow_background_color',
      [
        'label' => __('Background Color', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'background-color: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'arrow_background_hover_color',
      [
        'label' => __('Background Hover Color', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .splide__arrow:hover' => 'background-color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'arrow_border',
        'label' => __('Border', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .splide__arrow',
      ]
    );

    $this->add_control(
      'arrow_border_radius',
      [
        'label' => __('Border Radius', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%'],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Box_Shadow::get_type(),
      [
        'name' => 'arrow_box_shadow',
        'label' => __('Box Shadow', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .splide__arrow',
      ]
    );

    // SVG icon styles
    $this->add_control(
      'arrow_icon_heading',
      [
        'label' => __('Icon Styles', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_responsive_control(
      'arrow_icon_size',
      [
        'label' => __('Icon Size', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'em'],
        'range' => [
          'px' => [
            'min' => 5,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .splide__arrow i' => 'font-size: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'arrow_icon_color',
      [
        'label' => __('Icon Color', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .splide__arrow svg' => 'fill: {{VALUE}};',
          '{{WRAPPER}} .splide__arrow i' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'arrow_icon_hover_color',
      [
        'label' => __('Icon Hover Color', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .splide__arrow:hover svg' => 'fill: {{VALUE}};',
          '{{WRAPPER}} .splide__arrow:hover i' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'arrow_icon_stroke_color',
      [
        'label' => __('Icon Stroke Color', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .splide__arrow svg' => 'stroke: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'arrow_icon_stroke_hover_color',
      [
        'label' => __('Icon Stroke Hover Color', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .splide__arrow:hover svg' => 'stroke: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'arrow_border',
        'label' => __('Border', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .splide__arrow',
        'fields_options' => [
          'border' => [
            'responsive' => true,
          ],
          'width' => [
            'responsive' => true,
            'selectors' => [
              '{{WRAPPER}} .splide__arrow' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
          ],
          'color' => [
            'responsive' => true,
          ],
        ],
      ]
    );

    // Add responsive border radius control (replace the existing one)
    $this->add_responsive_control(
      'arrow_border_radius',
      [
        'label' => __('Border Radius', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    // Add responsive border hover color control
    $this->add_control(
      'arrow_border_color',
      [
        'label' => __('Border Hover Color', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'border-color: {{VALUE}};',
        ],
        'separator' => 'before',
      ]
    );

    // Add responsive border hover color control
    $this->add_control(
      'arrow_border_hover_color',
      [
        'label' => __('Border Hover Color', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .splide__arrow:hover' => 'border-color: {{VALUE}};',
        ],
        'separator' => 'before',
      ]
    );

    // Add responsive border transition control
    $this->add_control(
      'arrow_border_transition',
      [
        'label' => __('Border Transition', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['s'],
        'range' => [
          's' => [
            'min' => 0,
            'max' => 3,
            'step' => 0.1,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'transition: border-color {{SIZE}}{{UNIT}} ease;',
        ],
      ]
    );

    $this->add_control(
      'arrow_opacity_heading',
      [
        'label' => __('Opacity', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    // Normal state opacity
    $this->add_responsive_control(
      'arrow_opacity',
      [
        'label' => __('Opacity', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 1,
            'step' => 0.01,
          ],
        ],
        'default' => [
          'size' => 1,
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'opacity: {{SIZE}};',
        ],
      ]
    );

    // Hover state opacity
    $this->add_responsive_control(
      'arrow_opacity_hover',
      [
        'label' => __('Hover Opacity', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 1,
            'step' => 0.01,
          ],
        ],
        'default' => [
          'size' => 1,
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__arrow:hover' => 'opacity: {{SIZE}};',
        ],
      ]
    );

    // Transition for smooth opacity changes
    $this->add_control(
      'arrow_opacity_transition',
      [
        'label' => __('Opacity Transition Duration (seconds)', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => 0,
        'max' => 1,
        'step' => 0.1,
        'default' => 0.3,
        'selectors' => [
          '{{WRAPPER}} .splide__arrow' => 'transition: opacity {{VALUE}}s ease;',
        ],
      ]
    );

    $this->end_controls_section();
  }
  protected function register_pagination_style_controls()
  {
    $this->start_controls_section(
      'pagination_style_section',
      [
        'label' => __('Pagination Dots', 'custom-slide-widget'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        'condition' => [
          'show_dots' => 'yes',
        ],
      ]
    );

    // Position controls
    $this->add_responsive_control(
      'pagination_position',
      [
        'label' => __('Position', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'absolute' => __('Absolute', 'custom-slide-widget'),
          'relative' => __('Relative', 'custom-slide-widget'),
          'fixed' => __('Fixed', 'custom-slide-widget'),
        ],
        'default' => 'absolute',
        'selectors' => [
          '{{WRAPPER}} .splide__pagination' => 'position: {{VALUE}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'pagination_bottom',
      [
        'label' => __('Bottom Position', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vh'],
        'range' => [
          'px' => [
            'min' => -100,
            'max' => 200,
          ],
          '%' => [
            'min' => -20,
            'max' => 100,
          ],
          'vh' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'default' => [
          'unit' => 'px',
          'size' => 10,
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__pagination' => 'bottom: {{SIZE}}{{UNIT}}; top: auto;',
        ],
        'condition' => [
          'pagination_position' => ['absolute', 'fixed'],
        ],
      ]
    );

    $this->add_responsive_control(
      'pagination_top',
      [
        'label' => __('Top Position', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vh'],
        'range' => [
          'px' => [
            'min' => -100,
            'max' => 200,
          ],
          '%' => [
            'min' => -20,
            'max' => 100,
          ],
          'vh' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__pagination' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
        ],
        'condition' => [
          'pagination_position' => ['absolute', 'fixed'],
        ],
      ]
    );

    $this->add_responsive_control(
      'pagination_left',
      [
        'label' => __('Left Position', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'range' => [
          'px' => [
            'min' => -100,
            'max' => 1000,
          ],
          '%' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__pagination' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
        ],
        'condition' => [
          'pagination_position' => ['absolute', 'fixed'],
        ],
      ]
    );

    $this->add_responsive_control(
      'pagination_right',
      [
        'label' => __('Right Position', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'range' => [
          'px' => [
            'min' => -100,
            'max' => 1000,
          ],
          '%' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__pagination' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
        ],
        'condition' => [
          'pagination_position' => ['absolute', 'fixed'],
        ],
      ]
    );
    $this->add_responsive_control(
      'pagination_vertical_offset',
      [
        'label' => __('Vertical Offset', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vh'],
        'range' => [
          'px' => [
            'min' => -200,
            'max' => 200,
          ],
          '%' => [
            'min' => -20,
            'max' => 100,
          ],
          'vh' => [
            'min' => -20,
            'max' => 100,
          ],
        ],
        'default' => [
          'unit' => 'px',
          'size' => 10,
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__pagination' => 'transform: translateY({{SIZE}}{{UNIT}});',
        ],
        'condition' => [
          'pagination_position' => ['absolute', 'fixed'],
        ],
      ]
    );

    $this->add_responsive_control(
      'pagination_horizontal_offset',
      [
        'label' => __('Horizontal Offset', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'range' => [
          'px' => [
            'min' => -500,
            'max' => 500,
          ],
          '%' => [
            'min' => -100,
            'max' => 100,
          ],
        ],
        'default' => [
          'unit' => 'px',
          'size' => 0,
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__pagination' => 'transform: translateX({{SIZE}}{{UNIT}});',
        ],
        'condition' => [
          'pagination_position' => ['absolute', 'fixed'],
        ],
      ]
    );

    $this->add_control(
      'pagination_dots_style',
      [
        'label' => __('Dots Style', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->start_controls_tabs('tabs_pagination_dots_style');
    $this->start_controls_tab(
      'tab_pagination_dots_normal_style',
      [
        'label' => __('Normal Dot', 'custom-slide-widget'),
      ],
    );

    $this->add_responsive_control(
      'pagination_dots_width',
      [
        'label' => __('Dots Width', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
          'px' => [
            'min' => 2,
            'max' => 30,
          ],
        ],
        'default' => [
          'size' => 8,
          'unit' => 'px',
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__pagination__page' => 'width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    // Height control
    $this->add_responsive_control(
      'pagination_dots_height',
      [
        'label' => __('Dots Height', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
          'px' => [
            'min' => 2,
            'max' => 30,
          ],
        ],
        'default' => [
          'size' => 8,
          'unit' => 'px',
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__pagination__page' => 'height: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name' => 'pagination_dots_bg',
        'label' => __('Background', 'custom-slide-widget'),
        'types' => ['classic', 'gradient'],
        'selector' => '{{WRAPPER}} .splide__pagination__page',
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'pagination_dots_border',
        'label' => __('Border', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .splide__pagination__page',
      ]
    );

    $this->add_responsive_control(
      'pagination_dots_border_radius',
      [
        'label' => __('Border Radius', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%'],
        'selectors' => [
          '{{WRAPPER}} .splide__pagination__page' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Box_Shadow::get_type(),
      [
        'name' => 'pagination_dots_box_shadow',
        'label' => __('Box Shadow', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .splide__pagination__page',
      ]
    );

    $this->end_controls_tab();
    $this->start_controls_tab(
      'tab_pagination_dots_active_style',
      [
        'label' => __('Active Dot', 'custom-slide-widget'),
      ],
    );

    $this->add_control(
      'pagination_dots_active_style',
      [
        'label' => __('Active Dot Style', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name' => 'pagination_dots_active_bg',
        'label' => __('Active Background', 'custom-slide-widget'),
        'types' => ['classic', 'gradient'],
        'selector' => '{{WRAPPER}} .splide__pagination__page.is-active',
      ]
    );

    $this->add_control(
      'pagination_dots_active_border_color',
      [
        'label' => __('Active Border Color', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .splide__pagination__page.is-active' => 'border-color: {{VALUE}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'pagination_dots_active_width',
      [
        'label' => __('Active Dots Width', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
          'px' => [
            'min' => 2,
            'max' => 30,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__pagination__page.is-active' => 'width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    // Height control
    $this->add_responsive_control(
      'pagination_dots_active_height',
      [
        'label' => __('Active Dots Height', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
          'px' => [
            'min' => 2,
            'max' => 30,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__pagination__page.is-active' => 'height: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'pagination_dots_active_scale',
      [
        'label' => __('Active Dot Scale', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
          'px' => [
            'min' => 0.5,
            'max' => 2,
            'step' => 0.1,
          ],
        ],
        'default' => [
          'size' => 1.2,
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__pagination__page.is-active' => 'transform: scale({{SIZE}});',
        ],
      ]
    );

    $this->end_controls_tab();

    $this->end_controls_tabs();


    $this->add_responsive_control(
      'pagination_dots_gap',
      [
        'label' => __('Dots Spacing', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 30,
          ],
        ],
        'default' => [
          'size' => 6,
          'unit' => 'px',
        ],
        'selectors' => [
          '{{WRAPPER}} .splide__pagination__page' => 'margin: 0 {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->end_controls_section();
  }
  protected function register_button_style_controls()
  {
    $this->start_controls_section(
      'buttons_style_section',
      [
        'label' => __('Button Style', 'custom-slide-widget'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'button_heading',
      [
        'label' => __('Button Container', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'after',
        // 'condition' => [
        //   'show_arrows' => 'yes',
        // ],
      ]
    );

    $this->add_control(
      'button_container_layout',
      [
        'label' => __('Layout', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'block' => __('Block', 'custom-slide-widget'),
          'flex' => __('Flex', 'custom-slide-widget'),
          'grid' => __('Grid', 'custom-slide-widget'),
        ],
        'default' => 'flex',
        'selectors' => [
          '{{WRAPPER}} .slide-button-container' => 'display: {{value}};'
        ],
      ],
    );

    $this->add_responsive_control(
      'btn_container_flex_direction',
      [
        'label' => __('Flex Direction', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'row' => __('Row', 'custom-slide-widget'),
          'column' => __('Column', 'custom-slide-widget'),
          'row-reverse' => __('Row Reverse', 'custom-slide-widget'),
          'column-reverse' => __('Column Reverse', 'custom-slide-widget'),
        ],
        'default' => 'row',
        'selectors' => [
          '{{WRAPPER}} .slide-button-container' => 'flex-direction:{{VALUE}}'
        ],
        'condition' => [
          'button_container_layout' => 'flex',
        ],
      ]
    );
    $this->add_control(
      'btn_container_align_items',
      [
        'label' => __('Align Items', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'start',
        'options' => [
          'flex-start' => __('Start', 'custom-slide-widget'),
          'flex-end' => __('End', 'custom-slide-widget'),
          'center' => __('Center', 'custom-slide-widget'),
          'baseline' => __('Baseline', 'custom-slide-widget'),
          'stretch' => __('Stretch', 'custom-slide-widget'),
        ],
        'selectors' => [
          '{{WRAPPER}} .slide-button-container' => 'align-items: {{VALUE}};',
        ],
        'condition' => [
          'button_container_layout' => 'flex',
        ],
      ]
    );

    $this->add_control(
      'btn_container_justify_content',
      [
        'label' => __('Justify Content', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'flex-start',
        'options' => [
          'flex-start' => __('Start', 'custom-slide-widget'),
          'flex-end' => __('End', 'custom-slide-widget'),
          'center' => __('Center', 'custom-slide-widget'),
          'baseline' => __('Baseline', 'custom-slide-widget'),
          'stretch' => __('Stretch', 'custom-slide-widget'),
        ],
        'selectors' => [
          '{{WRAPPER}} .slide-button-container' => 'justify-content: {{VALUE}};',
        ],
        'condition' => [
          'button_container_layout' => 'flex',
        ],
      ]
    );

    $this->add_control(
      'btn_container_flex_wrap',
      [
        'label' => __('Flex Wrap', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'custom-slide-widget'),
        'label_off' => __('No', 'custom-slide-widget'),
        'return_value' => 'wrap',
        'default' => '',
        'selectors' => [
          '{{WRAPPER}} .slide-button-container' => 'flex-wrap: {{VALUE}};'
        ],
        'condition' => [
          'button_container_layout' => 'flex',
        ],
      ],
    );

    $this->add_responsive_control(
      'btn_container_margin',
      [
        'label' => __('Margin', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'rem'],
        'selectors' => [
          '{{WRAPPER}} .slide-button-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
        ],
      ],
    );

    $this->add_responsive_control(
      'btn_container_padding',
      [
        'label' => __('Padding', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'rem', ''],
        'selectors' => [
          '{{WRAPPER}} .slide-button-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
        ],
      ],
    );

    // primary button style
    $this->add_control(
      'primary_button_style',
      [
        'label' => __('Primary Button Style', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'primary_btn_typography', // Used internally
        'label' => __('Typography Primary Btn', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .slide-primary-button',

      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'secondary_btn_typography', // Used internally
        'label' => __('Typography Secondary Btn', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .slide-secondary-button',
      ]
    );


    $this->start_controls_tabs('tabs_primary-btn_style');
    $this->start_controls_tab(
      'tab_primary_btn_normal',
      [
        'label' => __('Normal', 'custom-slide-widget'),
      ],
    );
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name' => 'primary_btn_background',
        'label' => __('Background', 'custom-slide-widget'),
        'types' => ['classic', 'gradient'],
        'selector' => '{{WRAPPER}} .slide-primary-button',
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name' => 'secondary_btn_background',
        'label' => __('Background', 'custom-slide-widget'),
        'types' => ['classic', 'gradient'],
        'selector' => '{{WRAPPER}} .slide-secondary-button',
      ]
    );
    $this->add_control(
      'primary_button_border_heading',
      [
        'label' => __('Primary Button border', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
      ]
    );
    // Border
    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'primary_btn_border',
        'selector' => '{{WRAPPER}} .slide-primary-button',
      ]
    );
    $this->add_control(
      'secondary_button_border_heading',
      [
        'label' => __('Secondary Button border', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'secondary_btn_border',
        'selector' => '{{WRAPPER}} .slide-secondary-button',
      ]
    );

    $this->add_control(
      'btn_border_radius',
      [
        'label' => __('Border Radius', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%'],
        'selectors' => [
          '{{WRAPPER}} .slide-primary-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          '{{WRAPPER}} .slide-secondary-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    // Box Shadow
    $this->add_group_control(
      \Elementor\Group_Control_Box_Shadow::get_type(),
      [
        'name' => 'primary_btn_box_shadow',
        'selector' => '{{WRAPPER}} .slide-primary-button',
      ]
    );

    $this->end_controls_tab();
    $this->start_controls_tab(
      'tab_primary_btn_hover',
      [
        'label' => __('Hover', 'custom-slide-widget'),
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name' => 'primary_btn_background_hover',
        'label' => __('Background', 'custom-slide-widget'),
        'types' => ['classic', 'gradient'],
        'selector' => '{{WRAPPER}} .slide-primary-button:hover',
      ]
    );
    $this->add_control(
      'primary_button_border_heading_hover',
      [
        'label' => __('Primary Button border', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
      ]
    );
    // Border
    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'primary_btn_border_hover',
        'selector' => '{{WRAPPER}} .slide-primary-button:hover',
      ]
    );
    $this->add_control(
      'secondary_button_border_heading_hover',
      [
        'label' => __('Secondary Button border', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'secondary_btn_border_hover',
        'selector' => '{{WRAPPER}} .slide-secondary-button:hover',
      ]
    );

    $this->add_control(
      'btn_border_radius_hover',
      [
        'label' => __('Border Radius', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%'],
        'selectors' => [
          '{{WRAPPER}} .slide-primary-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          '{{WRAPPER}} .slide-secondary-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    // Box Shadow
    $this->add_group_control(
      \Elementor\Group_Control_Box_Shadow::get_type(),
      [
        'name' => 'primary_btn_box_shadow_hover',
        'selector' => '{{WRAPPER}} .slide-primary-button:hover',
      ]
    );
    // Hover Animation
    $this->add_control(
      'primary_btn_hover_animation',
      [
        'label' => __('Hover Animation', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
        'prefix_class' => 'elementor-animation-',
      ]
    );
    // Transition Duration
    $this->add_control(
      'primary_btn_hover_transition',
      [
        'label' => __('Transition Duration (s)', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
          's' => [
            'min' => 0,
            'max' => 3,
            'step' => 0.1,
          ],
        ],
        'default' => [
          'size' => 0.3
        ],
        'selectors' => [
          '{{WRAPPER}} .slide-primary-button' => 'transition-duration: {{SIZE}}s ease;',
        ],
      ]
    );
    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->add_responsive_control(
      'primary_btn_padding',
      [
        'label' => __('Padding', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'rem'],
        'selectors' => [
          '{{WRAPPER}} .slide-primary-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
        ],
      ],
    );
    $this->add_responsive_control(
      'primary_btn_margin',
      [
        'label' => __('Margin', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'rem'],
        'selectors' => [
          '{{WRAPPER}} .slide-primary-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
        ],
      ],
    );
    // secondary button style
    $this->add_control(
      'secondary_button_style',
      [
        'label' => __('Secondary Button Style', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'button_typography', // Used internally
        'label' => __('Typography', 'custom-slide-widget'),
        'selector' => '{{WRAPPER}} .slide-primary-button',
      ]
    );

    $this->start_controls_tabs('tabs_secondary-btn_style');
    $this->start_controls_tab(
      'tab_secondary_btn_normal',
      [
        'label' => __('Normal', 'custom-slide-widget'),
      ],
    );
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name' => 'secondary_btn_background',
        'label' => __('Background', 'custom-slide-widget'),
        'types' => ['classic', 'gradient'],
        'selector' => '{{WRAPPER}} .slide-secondary-button',
      ]
    );
    // Border
    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'secondary_btn_border',
        'selector' => '{{WRAPPER}} .slide-secondary-button',
      ]
    );
    // Box Shadow
    $this->add_group_control(
      \Elementor\Group_Control_Box_Shadow::get_type(),
      [
        'name' => 'secondary_btn_box_shadow',
        'selector' => '{{WRAPPER}} .slide-secondary-button',
      ]
    );

    $this->end_controls_tab();
    $this->start_controls_tab(
      'tab_secondary_btn_hover',
      [
        'label' => __('Hover', 'custom-slide-widget'),
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name' => 'secondary_btn_background_hover',
        'label' => __('Background', 'custom-slide-widget'),
        'types' => ['classic', 'gradient'],
        'selector' => '{{WRAPPER}} .slide-secondary-button:hover',
      ]
    );
    // Border
    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'secondary_btn_border_hover',
        'selector' => '{{WRAPPER}} .slide-secondary-button:hover',
      ]
    );
    // Box Shadow
    $this->add_group_control(
      \Elementor\Group_Control_Box_Shadow::get_type(),
      [
        'name' => 'secondary_btn_box_shadow_hover',
        'selector' => '{{WRAPPER}} .slide-secondary-button:hover',
      ]
    );
    // Hover Animation
    $this->add_control(
      'secondary_btn_hover_animation',
      [
        'label' => __('Hover Animation', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
        'prefix_class' => 'elementor-animation-',
      ]
    );
    // Transition Duration
    $this->add_control(
      'secondary_btn_hover_transition',
      [
        'label' => __('Transition Duration (s)', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
          's' => [
            'min' => 0,
            'max' => 3,
            'step' => 0.1,
          ],
        ],
        'default' => [
          'size' => 0.3
        ],
        'selectors' => [
          '{{WRAPPER}} .slide-primary-button' => 'transition-duration: {{SIZE}}s ease;',
        ],
      ]
    );
    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->add_responsive_control(
      'secondary_btn_padding',
      [
        'label' => __('Padding', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'rem'],
        'selectors' => [
          '{{WRAPPER}} .slide-secondary-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
        ],
      ],
    );
    $this->add_responsive_control(
      'secondary_btn_margin',
      [
        'label' => __('Margin', 'custom-slide-widget'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'rem'],
        'selectors' => [
          '{{WRAPPER}} .slide-secondary-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
        ],
      ],
    );

    $this->end_controls_section();
  }
  // Content Section



  protected function render()
  {
    $settings = $this->get_settings_for_display();

    if (empty($settings['slides'])) {
      return;
    }



    // Fallback icons
    $fallback_prev_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z" fill="currentColor"/></svg>';
    $fallback_next_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" fill="currentColor"/></svg>';

    // Get custom SVG if provided
    $custom_prev_svg = !empty($settings['custom_prev_icon_svg']) ? $settings['custom_prev_icon_svg'] : '';

    $custom_next_svg = !empty($settings['custom_next_icon_svg']) ? $settings['custom_next_icon_svg'] : '';

    // Prepare arrow icons
    $prev_icon = $custom_prev_svg ?: (!empty($settings['prev_icon']['value']) ?
      $this->render_icon($settings['prev_icon']) :
      $fallback_prev_icon);

    $next_icon = $custom_next_svg ?: (!empty($settings['next_icon']['value']) ?
      $this->render_icon($settings['next_icon']) :
      $fallback_next_icon);

    $slider_options = [
      'autoplay' => $settings['autoplay'] === 'yes',
      'pauseOnHover' => $settings['pauseOnHover'] === 'yes',
      'autoplay_speed' => $settings['autoplay_speed'],
      'loop' => $settings['loop'] === 'yes',
      'arrows' => $settings['show_arrows'] === 'yes',
      'pagination' => $settings['show_dots'] === 'yes',
      'prev_icon' => $prev_icon,
      'next_icon' => $next_icon,
    ];



    $this->add_render_attribute('slider', [
      'class' => 'elementor-splide-slider',
      'data-slider-settings' => wp_json_encode($slider_options),
    ]);
?>

    <div <?php echo $this->get_render_attribute_string('slider'); ?>>
      <div class="splide">
        <div class="splide__track">
          <ul class="splide__list">
            <?php foreach ($settings['slides'] as $slide): ?>
              <li class="splide__slide">
                <div class="splide-slide-content <?php echo $settings['content_container_width'] ?>">
                  <?php if (!empty($slide['slide_image']['url'])): ?>
                    <?php if ('bg' === $settings['image_type']): ?>
                      <div class="splide-slide-image-bg" style="background-image: url('<?php echo esc_url($slide['slide_image']['url']); ?>')"></div>
                    <?php else: ?>
                      <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($slide, 'slide_image', 'full', ['class' => 'splide-slide-image']); ?>
                    <?php endif; ?>
                  <?php endif; ?>

                  <?php if ('yes' === $settings['show_overlay']): ?>
                    <div class="splide-slide-overlay"></div>
                  <?php endif; ?>

                  <div class="slide-details">
                    <?php if (!empty($slide['slide_title'])): ?>
                      <h1 class="splide-slide-title"><?php echo $slide['slide_title']; ?></h1>
                    <?php endif; ?>

                    <?php if (!empty($slide['slide_description'])): ?>
                      <div class="splide-slide-description"><?php echo wp_kses_post($slide['slide_description']); ?></div>
                    <?php endif; ?>

                    <?php
                    $descriptions = !empty($slide['descriptions']) ? explode("\n", $slide['descriptions']) : [];
                    if (!empty($descriptions)): ?>
                      <div class="description-container">
                        <?php for ($i = 0; $i < count($descriptions); $i += 2): ?>
                          <?php
                          $heading = trim($descriptions[$i] ?? '');
                          $text = trim($descriptions[$i + 1] ?? '');
                          if ($heading || $text): ?>
                            <div class="description-item">
                              <?php if ($heading): ?>
                                <p class="description-heading"><?php echo esc_html($heading); ?></p>
                              <?php endif; ?>
                              <?php if ($text): ?>
                                <p class="description-text"><?php echo esc_html($text); ?></p>
                              <?php endif; ?>
                            </div>
                          <?php endif; ?>
                        <?php endfor; ?>
                      </div>
                    <?php endif; ?>
                    <div class="slide-button-container">

                      <?php if (!empty($slide['slide_primary_link']['url'])): ?>
                        <a href="<?php echo esc_url($slide['slide_primary_link']['url']); ?>" class="slide-primary-button">
                          <?php echo esc_html($slide['slide_primary_link_text']); ?>
                        </a>
                      <?php endif; ?>
                      <?php if (!empty($slide['slide_secondary_link']['url'])): ?>
                        <a href="<?php echo esc_url($slide['slide_secondary_link']['url']); ?>" class="slide-secondary-button">
                          <?php echo esc_html($slide['slide_secondary_link_text']); ?>
                        </a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const sliders = document.querySelectorAll('.elementor-splide-slider');

        sliders.forEach(function(slider) {
          const settings = JSON.parse(slider.dataset.sliderSettings);
          const splideEl = slider.querySelector('.splide');

          // Initialize Splide
          const splide = new Splide(splideEl, {
            type: settings.loop ? 'loop' : 'slide',
            perPage: 1,
            perMove: 1,
            arrows: settings.arrows,
            pagination: settings.pagination,
            autoplay: settings.autoplay,
            interval: settings.autoplay_speed || 3000,
            pauseOnHover: settings.pauseOnHover,
            pauseOnFocus: true,
            breakpoints: {
              768: {
                arrows: settings.arrows,
                pagination: settings.pagination,
              }
            }
          }).mount();

          // Custom arrow icons
          if (settings.arrows) {
            const arrows = splideEl.querySelectorAll('.splide__arrow');
            if (arrows.length === 2) {
              arrows[0].innerHTML = settings.prev_icon;
              arrows[1].innerHTML = settings.next_icon;
            }
          }
        });
      });
    </script>
  <?php
  }

  private function render_icon($icon_settings)
  {
    if (!empty($icon_settings['value'])) {
      ob_start();
      \Elementor\Icons_Manager::render_icon($icon_settings, ['aria-hidden' => 'true']);
      return ob_get_clean();
    }
    return '';
  }

  protected function content_template()
  {
  ?>
    <#
      // Fallback icons
      var fallbackPrevIcon='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z" fill="currentColor"/></svg>' ;
      var fallbackNextIcon='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" fill="currentColor"/></svg>' ;

      // Get icons
      var customPrevSvg=settings.custom_prev_icon_svg ? settings.custom_prev_icon_svg : '' ;
      var customNextSvg=settings.custom_next_icon_svg ? settings.custom_next_icon_svg : '' ;

      var prevIcon=customPrevSvg ? customPrevSvg :
      (settings.prev_icon.value ?
      elementor.helpers.renderIcon(view, settings.prev_icon, { 'aria-hidden' : true }).value :
      fallbackPrevIcon);

      var nextIcon=customNextSvg ? customNextSvg :
      (settings.next_icon.value ?
      elementor.helpers.renderIcon(view, settings.next_icon, { 'aria-hidden' : true }).value :
      fallbackNextIcon);

      var sliderOptions={
      autoplay: 'yes'===settings.autoplay,
      autoplay_speed: settings.autoplay_speed,
      pauseOnHover: 'yes'===settings.pauseOnHover,
      loop: 'yes'===settings.loop,
      arrows: 'yes'===settings.show_arrows,
      pagination: 'yes'===settings.show_dots,
      prev_icon: prevIcon,
      next_icon: nextIcon
      };
      #>

      <div class="elementor-splide-slider" data-slider-settings="{{ JSON.stringify(sliderOptions) }}">
        <div class="splide">
          <div class="splide__track">
            <ul class="splide__list">
              <# _.each(settings.slides, function(slide) { #>
                <li class="splide__slide">
                  <div class="splide-slide-content">
                    <# if (slide.slide_image && slide.slide_image.url) { #>
                      <# if ('bg'===settings.image_type) { #>
                        <div class="splide-slide-image-bg" style="background-image: url('{{ slide.slide_image.url }}')"></div>
                        <# } else { #>
                          <img class="splide-slide-image" src="{{ slide.slide_image.url }}" alt="">
                          <# } #>
                            <# } #>

                              <# if ('yes'===settings.show_overlay) { #>
                                <div class="splide-slide-overlay"></div>
                                <# } #>

                                  <div class="slide-details">
                                    <# if (slide.slide_title) { #>
                                      <h1 class="splide-slide-title">{{{ slide.slide_title }}}</h1>
                                      <# } #>

                                        <# if (slide.slide_description) { #>
                                          <div class="splide-slide-description">{{{ slide.slide_description }}}</div>
                                          <# } #>

                                            <# if (slide.descriptions) {
                                              var descriptions=slide.descriptions.split('\n');
                                              #>
                                              <div class="description-container">
                                                <# for (var i=0; i < descriptions.length; i +=2) { #>
                                                  <#
                                                    var heading=descriptions[i] ? descriptions[i].trim() : '' ;
                                                    var text=descriptions[i+1] ? descriptions[i+1].trim() : '' ;
                                                    if (heading || text) { #>
                                                    <div class="description-item">
                                                      <# if (heading) { #>
                                                        <p class="description-heading">{{{ heading }}}</p>
                                                        <# } #>
                                                          <# if (text) { #>
                                                            <p class="description-text">{{{ text }}}</p>
                                                            <# } #>
                                                    </div>
                                                    <# } #>
                                                      <# } #>
                                              </div>
                                              <# } #>
                                                <div class="slide-button-container">

                                                  <# if (slide.slide_primary_link && slide.slide_primary_link.url) { #>
                                                    <a href="{{ slide.slide_primary_link.url }}" class="slide-primary-button">
                                                      {{{ slide.slide_primary_link_text }}}
                                                    </a>
                                                    <# } #>
                                                      <# if (slide.slide_secondary_link && slide.slide_secondary_link.url) { #>
                                                        <a href="{{ slide.slide_secondary_link.url }}" class="slide-secondary-button">
                                                          {{{ slide.slide_secondary_link_text }}}
                                                        </a>
                                                        <# } #>
                                                </div>
                                  </div>
                  </div>
                </li>
                <# }); #>
            </ul>
          </div>
        </div>
      </div>

      <script>
        (function() {
          const initSliders = function() {
            const sliders = document.querySelectorAll('.elementor-splide-slider:not([data-initialized])');

            sliders.forEach(function(slider) {
              const settings = JSON.parse(slider.dataset.sliderSettings);
              const splideEl = slider.querySelector('.splide');

              // Initialize Splide
              const splide = new Splide(splideEl, {
                type: settings.loop ? 'loop' : 'slide',
                perPage: 1,
                perMove: 1,
                arrows: settings.arrows,
                pagination: settings.pagination,
                autoplay: settings.autoplay,
                interval: settings.autoplay_speed || 3000,
                pauseOnHover: settings.pauseOnHover,
                pauseOnFocus: true,
                breakpoints: {
                  768: {
                    arrows: settings.arrows,
                    pagination: settings.pagination,
                  }
                }
              }).mount();

              // Custom arrow icons
              if (settings.arrows) {
                const arrows = splideEl.querySelectorAll('.splide__arrow');
                if (arrows.length === 2) {
                  arrows[0].innerHTML = settings.prev_icon;
                  arrows[1].innerHTML = settings.next_icon;
                }
              }

              // Mark as initialized to prevent duplicate inits
              slider.setAttribute('data-initialized', 'true');
            });
          };

          if (document.readyState === 'complete') {
            initSliders();
          } else {
            document.addEventListener('DOMContentLoaded', initSliders);
            // For Elementor editor
            if (window.elementorFrontend) {
              window.elementorFrontend.hooks.addAction('frontend/element_ready/global', initSliders);
            }
          }
        })();
      </script>
  <?php
  }
}
  ?>