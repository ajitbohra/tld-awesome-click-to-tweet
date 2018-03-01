/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const {
    InspectorControls,
    BlockControls,
} = wp.blocks;
const {
    PanelBody,
    TextareaControl,
    TextControl,
    SelectControl,
    RangeControl,
    ToggleControl,
} = wp.components;

/**
* Create an Inspector Controls wrapper Component
*/

const Inspector = (props) => {
    return (
        <InspectorControls key="inspector">
            <PanelBody title={__('Tweet Settings')} >
                <TextareaControl
                    label={__('Tweet Text')}
                    value={props.attributes.tweet}
                    onChange={props.onChangeTweet}
                    help={__('You can add hashtags and mentions here that will be part of the actual tweet, but not of the display on your post.')}
                />
                <TextControl
                    label={__('Button Text')}
                    value={props.attributes.button}
                    onChange={props.onChangeButton}
                />
            </PanelBody>
            <PanelBody title={__('Animation Settings')} >
                <SelectControl
                    label={__('Animation')}
                    value={props.attributes.animation}
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
                    onChange={props.onChangeAnimation}
                />
                {props.attributes.animation !== 'none' ?
                    <div className="if-animation-enable">
                        <RangeControl
                            label={__('Animation Duration (Seconds)')}
                            value={props.attributes.duration || 1}
                            onChange={props.onChangeDuration}
                            min={1}
                            max={9}
                            beforeIcon="clock"
                            allowReset
                        />
                        <RangeControl
                            label={__('Animation Delay (Seconds)')}
                            value={props.attributes.delay || 1}
                            onChange={props.onChangeDelay}
                            min={1}
                            max={9}
                            beforeIcon="clock"
                            allowReset
                        />
                        <ToggleControl
                            label={__('Loop Animation?')}
                            checked={!!props.attributes.infinite}
                            onChange={props.toggleInfinite}
                        />
                    </div> :
                    null
                }
            </PanelBody>
        </InspectorControls>
    )   
}

export default Inspector;