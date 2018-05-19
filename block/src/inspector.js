/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import { InspectorControls } from "@wordpress/editor";
import {
  PanelBody,
  TextareaControl,
  TextControl,
  SelectControl,
  RangeControl,
  ToggleControl
} from "@wordpress/components";

/**
 * Create Inspector Controls wrapper Component
 */

const Inspector = ({ attributes, setAttributes }) => {
  const { tweet, button, animation, infinite, duration, delay } = attributes;
  // Events
  const onChangeTweet = newTweet => {
    setAttributes({ tweet: newTweet });
  };
  const onChangeButton = newButton => {
    setAttributes({ button: newButton });
  };
  const onChangeAnimation = newAnimation => {
    setAttributes({ animation: newAnimation });
  };
  const toggleInfinite = () => {
    setAttributes({ infinite: !infinite });
  };
  const onChangeDuration = newDuration => {
    setAttributes({ duration: newDuration });
  };
  const onChangeDelay = newDelay => {
    setAttributes({ delay: newDelay });
  };

  // UI
  return (
    <InspectorControls key="inspector">
      <PanelBody title={__("Tweet Settings")}>
        <TextareaControl
          label={__("Tweet Text")}
          value={tweet}
          onChange={onChangeTweet}
          help={__(
            "You can add hashtags and mentions here that will be part of the actual tweet, but not of the display on your post."
          )}
        />
        <TextControl
          label={__("Button Text")}
          value={button}
          onChange={onChangeButton}
        />
      </PanelBody>
      <PanelBody title={__("Animation Settings")}>
        <SelectControl
          label={__("Animation")}
          value={animation}
          options={[
            {
              label: __("None"),
              value: "none"
            },
            {
              label: __("Pulse"),
              value: "pulse"
            },
            {
              label: __("Tada"),
              value: "tada"
            },
            {
              label: __("Bounce"),
              value: "bounce"
            }
          ]}
          onChange={onChangeAnimation}
        />
        {animation !== "none" && (
          <div className="if-animation-enable">
            <RangeControl
              label={__("Animation Duration (Seconds)")}
              value={duration || 1}
              onChange={onChangeDuration}
              min={1}
              max={9}
              beforeIcon="clock"
              allowReset
            />
            <RangeControl
              label={__("Animation Delay (Seconds)")}
              value={delay || 1}
              onChange={onChangeDelay}
              min={1}
              max={9}
              beforeIcon="clock"
              allowReset
            />
            <ToggleControl
              label={__("Loop Animation?")}
              checked={!!infinite}
              onChange={toggleInfinite}
            />
          </div>
        )}
      </PanelBody>
    </InspectorControls>
  );
};

export default Inspector;
