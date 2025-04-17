<?php 


// in includes/controls/class-nested-select2.php
if (!defined('ABSPATH')) {
    exit;
}

class Nested_Select2_Control extends \Elementor\Control_Select2 {

    public function get_type() {
        return 'nested_select2';
    }

    protected function get_default_settings() {
        return array_merge(parent::get_default_settings(), [
            'options' => [],
            'sortable' => false,
            'nested_data' => [], // Our custom nested data structure
            'placeholder'=>"Select",
        ]);
    }

    public function content_template() {
            ?>
             <#
              jQuery(document).ready(function() {
                const selectElement = jQuery('.smdp-'+data.name);
                
                if (selectElement.length) {
                    
                  const select2Settings = Object.assign({                    
                    selectOnClose: true,
                    allowClear: true,
                    placeholder: "Select 2",
                    selectionCssClass: "my-class-section",
                    templateResult: function(option) {
                        if (!option.id) return option.text;
                        const iconSrc = option.element.getAttribute("data-icon");
                        const styles = option.element.getAttribute("style");                       
                        const icon = iconSrc!=='false' ? `<img class="icon" src="${iconSrc}">` : '';
                        const cls = option.element.className ? ` class="${option.element.className}"` : '';
                        const styl = styles ? ` style="${styles}"`:``;
                        
                        return jQuery(`<span${cls}${styl}>${icon}${option.text}</span>`);
                    },

                    templateSelection: function(option) {
                        if (!option.id) return option.text;

                        const iconSrc = option.element.getAttribute("data-icon");
                        const icon = iconSrc!=='false' ? `<img class="icon" src="${iconSrc}">` : '';
                        return jQuery(`<span class="cont">${icon}${option.text}</span>`);
                    },

                  }, data.select2options);
                  selectElement.select2(select2Settings);
                }
            });
                function renderCategory(item, prefix = 0) {
                    if (!item) return;
                    <!-- console.log(item); -->
                    let padding = '', classes = '';
                    if (prefix !== 0) {
                        padding = ' style="padding-left:' + prefix + 'em;"';
                    } else {
                        classes = ' class="parent"';
                    }

                    const optionHTML = `<option${padding}${classes} value="${item.id}" data-icon="${item.icon}">${item.name}</option>`;
                    print(optionHTML);
                    // Recursively process children
                    if (!_.isEmpty(item.children)) {
                        _.each(item.children, function(child, index, list) {
                            let newPrefix = prefix + 1;
                            renderCategory(child, newPrefix);
                        });
                    }
                }
            #>

            <div class="elementor-control-field">
			<#
           
            
                
            if ( data.label ) {#>
				<label for="<?= $this->get_control_uid(); ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<# } #>
			<div class="elementor-control-input-wrapper elementor-control-unit-5">
				<# var multiple = ( data.multiple ) ? 'multiple' : ''; #>
				<select id="<?= $this->get_control_uid(); ?>" class="elementor-select2 smdp-{{data.name}}" type="select2" {{ multiple }} data-setting="{{ data.name }}">
					<# _.each( data.nested_data, function( option ) {
                        <!-- console.log(option_title,option_title); -->
						var value = data.controlValue;
						if ( typeof value == 'string' ) {
							var selected = ( option.id.toString() === value ) ? 'selected' : '';
						} else if ( null !== value ) {
							var value = _.values( value );
							var selected = ( -1 !== value.indexOf( option.id.toString() ) ) ? 'selected' : '';
						}
                        
                        renderCategory(option);
						 } 
                        );
                     #>
				</select>
			</div>
		</div>
		<# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
            <?php
        }



}