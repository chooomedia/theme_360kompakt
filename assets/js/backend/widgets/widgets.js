const { __ } = wp.i18n;
const { registerBlockStyle } = wp.blocks;

registerBlockStyle( 'core/group', {
    name: 'is-kompakt-slider',
    label: __('As Slider', 'kompakt')
} );