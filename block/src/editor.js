/**
 * External dependencies
 */
import classnames from "classnames";

/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import { Fragment } from "@wordpress/element";
import { RichText } from "@wordpress/editor";

/**
 * Block dependencies
 */
import Inspector from "./inspector";
import Controls from "./controls";
import "./editor.scss";

/**
 * Block edit component
 */
const editor = props => {
  const { attributes, setAttributes, className } = props;
  const {
    animation,
    theme,
    font,
    infinite,
    duration,
    delay,
    tweet,
    tweetmask,
    button
  } = attributes;
  // Event(s)
  const onChangeTweetMask = newTweetMask => {
    setAttributes({ tweetmask: newTweetMask });
  };

  // UI
  return (
    <Fragment>
      <Inspector {...{ ...props }} />
      <Controls {...{ ...props }} />
      <div className={className}>
        <div
          id="tld-actt-tweet-container"
          className={classnames(
            `tld-actt-${theme}`,
            font,
            animation,
            { animated: animation !== "none" },
            { infinite: !!infinite }
          )}
          style={{
            "animation-duration": `${duration}s`,
            "animation-delay": `${delay}s`
          }}
        >
          <RichText
            format="string"
            tagName="p"
            placeholder={__("Your Tweet")}
            onChange={onChangeTweetMask}
            value={tweetmask}
            formattingControls={[]}
          />
          <div
            className={classnames(
              "tld-actt-tweet-text",
              { "tld-actt-white-btn-text": theme === "bbutton" },
              { "tld-actt-btn-full": theme === "bbutton" }
            )}
          >
            <a
              className={theme !== "bbutton" ? "tld-actt-btn-default" : ""}
              target="_blank"
              href={`https://twitter.com/intent/tweet?text=${
                tweet !== undefined ? tweet : tweetmask
              }`}
            >
              <span>{button}</span>
              <span className="icon-twitter" />
            </a>
          </div>
        </div>
      </div>
    </Fragment>
  );
};

export default editor;
