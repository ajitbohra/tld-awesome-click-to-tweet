/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";

/**
 * Block attributes object
 */
const attributes = {
  tweetmask: {
    type: "string"
  },
  tweet: {
    type: "string"
  },
  button: {
    type: "string",
    default: __("Tweet Now")
  },
  theme: {
    type: "string",
    default: "bbutton"
  },
  font: {
    type: "string",
    default: "poiret-one"
  },
  animation: {
    type: "string",
    default: "none"
  },
  infinite: {
    type: "boolean",
    default: false
  },
  duration: {
    type: "number",
    default: 1
  },
  delay: {
    type: "number",
    default: 1
  }
};

export default attributes;
