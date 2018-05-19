/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import { registerBlockType } from "@wordpress/blocks";

/**
 * Block dependencies
 */
import blockAttributes from "./attributes";
import editor from "./editor";
import render from "./render";

/**
 * Register block
 */
export default registerBlockType("thelonedev/clicktotweet", {
  title: __("Click to Tweet"),
  category: "widgets",
  icon: "twitter",
  keywords: [__("Twitter"), __("Tweet")],
  attributes: blockAttributes,
  edit: editor,
  save: render
});
