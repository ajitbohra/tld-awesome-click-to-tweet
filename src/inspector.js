/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;
const {
    InspectorControls,
    BlockControls,
} = wp.blocks;
const {
	PanelBody,
} = wp.components;
const {
	TextareaControl,
    TextControl,
    SelectControl,
    RangeControl,
    ToggleControl,
} = InspectorControls;

/**
* Create an Inspector Controls wrapper Component
*/
export default class Inspector extends Component {
    constructor(props) {
        super(...arguments);
    }

    render() {
        return (
            <InspectorControls key="inspector">
                <PanelBody title={__('Tweet Settings')} >
                    <TextareaControl
                        label={__('Tweet Text')}
                        value={this.props.attributes.tweet}
                        onChange={this.props.onChangeTweet}
                        help={__('You can add hashtags and mentions here that will be part of the actual tweet, but not of the display on your post.')}
                    />
                    <TextControl
                        label={__('Button Text')}
                        value={this.props.attributes.button}
                        onChange={this.props.onChangeButton}
                    />
                </PanelBody>
                <PanelBody title={__('Animation Settings')} >
                    <SelectControl
                        label={__('Animation')}
                        value={this.props.attributes.animation}
                        options={[
                            {
                                label: __('None'),
                                value: 'none',
                            },
                            {
                                label: __('Pulse'),
                                value: 'pulse',
                            },
                            {
                                label: __('Tada'),
                                value: 'tada',
                            },
                            {
                                label: __('Bounce'),
                                value: 'bounce',
                            },
                        ]}
                        onChange={this.props.onChangeAnimation}
                    />
                    {this.props.attributes.animation !== 'none' ?
                        <div className="if-animation-enable">
                            <RangeControl
                                label={__('Animation Duration (Seconds)')}
                                value={this.props.attributes.duration || 1}
                                onChange={this.props.onChangeDuration}
                                min={1}
                                max={9}
                                beforeIcon="clock"
                                allowReset
                            />
                            <RangeControl
                                label={__('Animation Delay (Seconds)')}
                                value={this.props.attributes.delay || 1}
                                onChange={this.props.onChangeDelay}
                                min={1}
                                max={9}
                                beforeIcon="clock"
                                allowReset
                            />
                            <ToggleControl
                                label={__('Loop Animation?')}
                                checked={!!this.props.attributes.infinite}
                                onChange={this.props.toggleInfinite}
                            />
                        </div> :
                        null
                    }
                </PanelBody>
            </InspectorControls>
        )   
    }
}