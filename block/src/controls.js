/**
 * External dependencies
 */
import classnames from "classnames";

/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import { BlockControls } from "@wordpress/editor";
import { Toolbar, IconButton, DropdownMenu } from "@wordpress/components";

/**
 * Block dependencies
 */
import blockIcons from "./icons";

/**
 * Create BlockControls wrapper Component
 */
const Controls = ({ attributes: { theme }, setAttributes }) => {
  // Events
  const onChangeTheme = newTheme => {
    setAttributes({ theme: newTheme });
  };
  const onChangeFont = newFont => {
    setAttributes({ font: newFont });
  };

  // UI
  return (
    <BlockControls key="toolbar">
      <Toolbar>
        <IconButton
          icon={blockIcons.bbutton}
          label={__("Big Button")}
          onClick={() => onChangeTheme("bbutton")}
          className={classnames({ "tld-selected-icon": theme === "bbutton" })}
        />
        <IconButton
          icon={blockIcons.dashed}
          label={__("Dashed")}
          onClick={() => onChangeTheme("dashed")}
          className={classnames({ "tld-selected-icon": theme === "dashed" })}
        />
        <IconButton
          icon={blockIcons.minimalist}
          label={__("Minimalist")}
          onClick={() => onChangeTheme("minimalist")}
          className={classnames({
            "tld-selected-icon": theme === "minimalist"
          })}
        />
      </Toolbar>
      <Toolbar>
        <DropdownMenu
          icon="editor-textcolor"
          label={__("Font")}
          menuLabel={__("Font")}
          controls={[
            {
              title: __("Poiret One"),
              icon: "editor-textcolor",
              onClick: () => onChangeFont("poiret-one")
            },
            {
              title: __("Lobster Two"),
              icon: "editor-textcolor",
              onClick: () => onChangeFont("lobster-two")
            },
            {
              title: __("Raleway"),
              icon: "editor-textcolor",
              onClick: () => onChangeFont("raleway")
            },
            {
              title: __("Titillium Web"),
              icon: "editor-textcolor",
              onClick: () => onChangeFont("titillium-web")
            },
            {
              title: __("Indie Flower"),
              icon: "editor-textcolor",
              onClick: () => onChangeFont("indie-flower")
            }
          ]}
        />
      </Toolbar>
    </BlockControls>
  );
};

export default Controls;
