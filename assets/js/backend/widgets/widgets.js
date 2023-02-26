const { __ } = wp.i18n;
const { registerBlockStyle } = wp.blocks;

registerBlockStyle( 'core/group', {
    name: 'is-gpct-slider',
    label: __('As Slider', 'gpct')
} );