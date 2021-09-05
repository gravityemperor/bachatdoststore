<?php
/**
 * Define custom fields for widgets
 * 
 * @package Wpparallax
 */

function wp_parallax_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
    
    extract( $widget_field );

    switch ( $wpparallax_widgets_field_type ) {

        // Standard text field
        case 'text' :
        ?>
            <p class="field <?php echo esc_html( $wpparallax_widgets_class ); ?>" style="<?php echo esc_html( $wpparallax_widgets_style ); ?>">
                <label class="wtitle" for="<?php echo esc_attr( $instance->get_field_id( $wpparallax_widgets_name ) ); ?>"><?php echo esc_html( $wpparallax_widgets_title ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $wpparallax_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $wpparallax_widgets_name ) ); ?>" type="text" value="<?php echo esc_html( $athm_field_value ); ?>" />

                <?php if ( isset( $wpparallax_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $wpparallax_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Standard url field
        case 'url' :
        ?>
            <p class="field <?php echo esc_html( $wpparallax_widgets_class ); ?>" style="<?php echo esc_html( $wpparallax_widgets_style ); ?>">
                <label class="wtitle" for="<?php echo esc_attr( $instance->get_field_id( $wpparallax_widgets_name ) ); ?>"><?php echo esc_html( $wpparallax_widgets_title ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $wpparallax_widgets_name ) ); ?>" name="<?php echo esc_html( $instance->get_field_name( $wpparallax_widgets_name ) ); ?>" type="text" value="<?php echo esc_html( $athm_field_value ); ?>" />

                <?php if ( isset( $wpparallax_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $wpparallax_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Select field
        case 'select' :
            if( empty( $athm_field_value ) ) {
                $athm_field_value = $wpparallax_widgets_default;
            }
        ?>
            <p class="field <?php echo esc_html( $wpparallax_widgets_class ); ?>" style="<?php echo esc_html( $wpparallax_widgets_style ); ?>">
                <label class="wtitle" for="<?php echo esc_attr( $instance->get_field_id( $wpparallax_widgets_name ) ); ?>"><?php echo esc_html( $wpparallax_widgets_title ); ?>:</label>
                <select name="<?php echo esc_attr( $instance->get_field_name( $wpparallax_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $wpparallax_widgets_name ) ); ?>" class="widefat selectopt">
                    <?php foreach ( $wpparallax_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
                        <option value="<?php echo esc_attr($athm_option_name); ?>" id="<?php echo esc_attr( $instance->get_field_id($athm_option_name ) ); ?>" <?php selected( $athm_option_name, $athm_field_value ); ?>><?php echo esc_html( $athm_option_title ); ?></option>
                    <?php } ?>
                </select>

                <?php if ( isset( $wpparallax_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $wpparallax_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        case 'switch':
            if( empty( $athm_field_value ) ) {
                $athm_field_value = $wpparallax_widgets_default;
            }
        ?>
            <p>
                <label class="wtitle" for="<?php echo esc_attr( $instance->get_field_id( $wpparallax_widgets_name ) ); ?>"><?php echo esc_html( $wpparallax_widgets_title ); ?>:</label>
                <div class="widget_switch_options">
                    <?php 
                        foreach ( $wpparallax_widgets_field_options as $key => $value ) {
                            if( $key == $athm_field_value ) {
                                echo '<span class="widget_switch_part '.esc_attr($key).' selected" data-switch="'.esc_attr($key).'">'. esc_attr($value).'</span>';
                            } else {
                                echo '<span class="widget_switch_part '.esc_attr($key).'" data-switch="'.esc_attr($key).'">'. esc_attr($value).'</span>';
                            }                            
                        }
                    ?>
                    <input type="hidden" id="<?php echo esc_attr( $instance->get_field_id( $key ) ); ?>" name="<?php echo esc_html( $instance->get_field_name( $wpparallax_widgets_name ) ); ?>" value="<?php echo esc_attr($athm_field_value); ?>" />
                </div>
            </p>
        <?php
            break;


        case 'upload' :

            $output = '';
            $id = $instance->get_field_id( $wpparallax_widgets_name );
            $class = '';
            $int = '';
            $value = $athm_field_value;
            $name = $instance->get_field_name( $wpparallax_widgets_name );

            if ( $value ) {
                $class = ' has-file';
                $value = explode( 'wp-content', $value );
                $value = content_url().$value[1];
            }
            $output .= '<div class="sub-option widget-upload '.esc_html( $wpparallax_widgets_class ).'" style="'.esc_html( $wpparallax_widgets_style ).'">';
            $output .= '<label class="wtitle" for="' . $instance->get_field_id( $wpparallax_widgets_name ) . '">' . $wpparallax_widgets_title . '</label><br/>';
            $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . esc_attr__( 'No file chosen', 'wpparallax' ) . '" />' . "\n";
            if ( function_exists( 'wp_enqueue_media' ) ) {
                if ( ( $value == '') ) {
                    $output .= '<input id="upload-' . $id . '" class="ap-upload-button button" type="button" value="' . esc_attr__( 'Upload', 'wpparallax' ) . '" />' . "\n";
                } else {
                    $output .= '<input id="remove-' . $id . '" class="remove-file button" type="button" value="' . esc_attr__( 'Remove', 'wpparallax' ) . '" />' . "\n";
                }
            } else {
                $output .= '<p><i>' . esc_attr__( 'Upgrade your version of WordPress for full media support.', 'wpparallax' ) . '</i></p>';
            }

            $output .= '<div class="screenshot upload-thumb" id="' . $id . '-image">' . "\n";

            if ( $value != '' ) {
                $remove = '<a class="remove-image">'. esc_attr__( 'Remove', 'wpparallax' ).'</a>';
                $attachment_id = wpparallax_get_attachment_id_from_url( $value );
                $image_array = wp_get_attachment_image_src( $attachment_id, 'large' );
                $image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value );
                if ( $image ) {
                    $output .= '<img src="' . $image_array[0] . '" />';
                } else {
                    $parts = explode( "/", $value );
                    for ( $i = 0; $i < sizeof( $parts ); ++$i ) {
                        $title = $parts[$i];
                    }

                    // No output preview if it's not an image.
                    $output .= '';

                    // Standard generic output if it's not an image.
                    $title = esc_attr__( 'View File', 'wpparallax' );
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo ($output);
            break;

            case 'color' :
               ?>
               <p class="field <?php echo esc_html( $wpparallax_widgets_class ); ?>">
                   <label class="widget-label" for="<?php echo esc_attr($instance->get_field_id($wpparallax_widgets_name)); ?>"><?php echo esc_html($wpparallax_widgets_title); ?>:</label><br />
                   <input type="text" class="as-widget-color" name="<?php echo esc_attr($instance->get_field_name($wpparallax_widgets_name)); ?>" value="<?php echo esc_attr($athm_field_value); ?>" />
               </p>            
               <script type="text/javascript">
                    jQuery(document).ready(function($){
                       // Call Color Picker in Widget Area
                        $('.as-widget-color').wpColorPicker({
                            change: function(){$(this).trigger('change')}
                        });        
                    });
               </script>
               <?php
               break;

        case 'section_wrapper_start':
        ?>
            
            <div id="<?php echo esc_attr( $instance->get_field_name( $wpparallax_widgets_name ) );?>" class="section-wrapper <?php echo esc_attr( $wpparallax_widgets_class );?>" style="<?php echo esc_attr( $wpparallax_widgets_style );?>">
        <?php
            break;

        case 'section_wrapper_end':
        ?>
            </div>
        <?php
            break;

    }
}

function wp_parallax_widgets_updated_field_value( $widget_field, $new_field_value ) {
    extract( $widget_field );

 if ( $wpparallax_widgets_field_type == 'url' ) {
        return esc_url( $new_field_value );
    } else {
        return strip_tags( $new_field_value );
    }
}