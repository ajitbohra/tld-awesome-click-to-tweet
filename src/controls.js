/**
 * Block dependencies
 */
import classnames from 'classnames';
import blockIcons from './icons';


/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;
const {
    BlockControls,
} = wp.blocks;
const {
    Toolbar,
    IconButton,
    DropdownMenu,
} = wp.components;

/**
* Create an Inspector Controls wrapper Component
*/
export default class Controls extends Component {
    constructor(props) {
        super(...arguments);
    }

    render() {
        return (
            <BlockControls key="toolbar">
                <Toolbar>
                    <IconButton
                        icon={blockIcons.bbutton}
                        label={__('Big Button')}
                        onClick={() => this.props.onChangeTheme('bbutton')}
                        className={
                            classnames(
                                { 'tld-selected-icon': (this.props.attributes.theme === 'bbutton') },
                            )
                        }
                    />
                    <IconButton
                        icon={blockIcons.dashed}
                        label={__('Dashed')}
                        onClick={() => this.props.onChangeTheme('dashed')}
                        className={
                            classnames(
                                { 'tld-selected-icon': (this.props.attributes.theme === 'dashed') },
                            )
                        }
                    />
                    <IconButton
                        icon={blockIcons.minimalist}
                        label={__('Minimalist')}
                        onClick={() => this.props.onChangeTheme('minimalist')}
                        className={
                            classnames(
                                { 'tld-selected-icon': (this.props.attributes.theme === 'minimalist') },
                            )
                        }
                    />
                </Toolbar>
                <Toolbar>
                    <DropdownMenu
                        icon="editor-textcolor"
                        label={__('Font')}
                        menuLabel={__('Font')}
                        controls={[
                            {
                                title: __('Poiret One'),
                                icon: 'editor-textcolor',
                                onClick: () => this.props.onChangeFont('poiret-one'),
                            },
                            {
                                title: __('Lobster Two'),
                                icon: 'editor-textcolor',
                                onClick: () => this.props.onChangeFont('lobster-two'),
                            },
                            {
                                title: __('Raleway'),
                                icon: 'editor-textcolor',
                                onClick: () => this.props.onChangeFont('raleway'),
                            },
                            {
                                title: __('Titillium Web'),
                                icon: 'editor-textcolor',
                                onClick: () => this.props.onChangeFont('titillium-web'),
                            },
                            {
                                title: __('Indie Flower'),
                                icon: 'editor-textcolor',
                                onClick: () => this.props.onChangeFont('indie-flower'),
                            },
                        ]}
                    />
                </Toolbar>
            </BlockControls>
        )
    }
}