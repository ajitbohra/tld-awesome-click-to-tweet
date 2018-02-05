/**
 * Block dependencies
 */
import classnames from 'classnames';
import { bbutton, dashed, minimalist } from './icons';
import './editor.scss';

/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const {
	registerBlockType,
	Editable,
	InspectorControls,
	BlockControls,
} = wp.blocks;
const {
	PanelBody,
	Toolbar,
	IconButton,
	DropdownMenu,
} = wp.components;
const {
	TextareaControl,
	TextControl,
	SelectControl,
	RangeControl,
	ToggleControl,
} = InspectorControls;

/**
 * Register block
 */
export default registerBlockType(
	'thelonedev/clicktotweet',
	{
		title: __( 'Click to Tweet' ),
		category: 'widgets',
		icon: 'twitter',
		keywords: [
			__( 'Twitter' ),
			__( 'Tweet' ),
		],
		attributes: {
			tweetmask: {
				type: 'string',
			},
			tweet: {
				type: 'string',
			},
			button: {
				type: 'string',
				default: __( 'Tweet Now' ),
			},
			theme: {
				type: 'string',
				default: 'bbutton',
			},
			font: {
				type: 'string',
				default: 'poiret-one',
			},
			animaion: {
				type: 'string',
				default: 'none',
			},
			infinite: {
				type: 'boolean',
				default: false,
			},
			duration: {
				type: 'number',
				default: 1,
			},
			delay: {
				type: 'number',
				default: 1,
			},
		},
		edit: props => {
			const onChangeTweetMask = value => {
				props.setAttributes( { tweetmask: value[0] } );
			};
			const onChangeTweet = value => {
				props.setAttributes( { tweet: value } );
			};
			const onChangeButton = value => {
				props.setAttributes( { button: value } );
			};
			const onChangeTheme = value => {
				props.setAttributes( { theme: value } );
			};
			const onChangeFont = value => {
				props.setAttributes( { font: value } );
			};
			const onChangeAnimation = value => {
				props.setAttributes( { animaion: value } );
			};
			const toggleInfinite = () => {
				props.setAttributes( { infinite: ! props.attributes.infinite } );
			};
			const onChangeDuration = value => {
				props.setAttributes( { duration: value } );
			};
			const onChangeDelay = value => {
				props.setAttributes( { delay: value } );
			};
			const animation = !! props.focus && ( ( props.attributes.animaion === 'none' ) ? '' : props.attributes.animaion );
			const animationStyle = {
				'animation-duration': props.attributes.duration + 's',
				'animation-delay': props.attributes.delay + 's',
			};
			let boxTheme;
			if ( props.attributes.theme === 'dashed' ) {
				boxTheme = 'tld-actt-border-dashed';
			} else if ( props.attributes.theme === 'minimalist' ) {
				boxTheme = 'tld-actt-minimalist';
			} else {
				boxTheme = 'tld-actt-bbutton';
			}
			const fontStyle = props.attributes.font;
			return [
				!! props.focus && (
					<InspectorControls key="inspector">
						<PanelBody title={ __( 'Tweet Settings' ) } >
							<TextareaControl
								label={ __( 'Tweet Text' ) }
								value={ props.attributes.tweet	}
								onChange={ onChangeTweet }
								help={ __( 'You can add hashtags and mentions here that will be part of the actual tweet, but not of the display on your post.' ) }
							/>
							<TextControl
								label={ __( 'Button Text' ) }
								value={ props.attributes.button }
								onChange={ onChangeButton }
							/>
						</PanelBody>
						<PanelBody title={ __( 'Animation Settings' ) } >
							<SelectControl
								label={ __( 'Animation' ) }
								value={ props.attributes.animaion }
								options={ [
									{
										label: __( 'None' ),
										value: 'none',
									},
									{
										label: __( 'Pulse' ),
										value: 'pulse',
									},
									{
										label: __( 'Tada' ),
										value: 'tada',
									},
									{
										label: __( 'Bounce' ),
										value: 'bounce',
									},
								] }
								onChange={ onChangeAnimation }
							/>
							{ props.attributes.animaion !== 'none' ?
								<div className="if-animation-enable">
									<RangeControl
										label={ __( 'Animation Duration (Seconds)' ) }
										value={ props.attributes.duration || 1 }
										onChange={ onChangeDuration }
										min={ 1 }
										max={ 9 }
										beforeIcon="clock"
										allowReset
									/>
									<RangeControl
										label={ __( 'Animation Delay (Seconds)' ) }
										value={ props.attributes.delay || 1 }
										onChange={ onChangeDelay }
										min={ 1 }
										max={ 9 }
										beforeIcon="clock"
										allowReset
									/>
									<ToggleControl
										label={ __( 'Loop Animation?' ) }
										checked={ !! props.attributes.infinite }
										onChange={ toggleInfinite }
									/>
								</div> :
								null
							}
						</PanelBody>
					</InspectorControls>
				),
				!! props.focus && (
					<BlockControls key="toolbar">
						<Toolbar>
							<IconButton
								icon={ bbutton }
								label={ __( 'Big Button' ) }
								onClick={ () => onChangeTheme( 'bbutton' ) }
								className={
									classnames(
										{ 'tld-selected-icon': ( props.attributes.theme === 'bbutton' ) },
									)
								}
							/>
							<IconButton
								icon={ dashed }
								label={ __( 'Dashed' ) }
								onClick={ () => onChangeTheme( 'dashed' ) }
								className={
									classnames(
										{ 'tld-selected-icon': ( props.attributes.theme === 'dashed' ) },
									)
								}
							/>
							<IconButton
								icon={ minimalist }
								label={ __( 'Minimalist' ) }
								onClick={ () => onChangeTheme( 'minimalist' ) }
								className={
									classnames(
										{ 'tld-selected-icon': ( props.attributes.theme === 'minimalist' ) },
									)
								}
							/>
						</Toolbar>
						<Toolbar>
							<DropdownMenu
								icon="editor-textcolor"
								label={ __( 'Font' ) }
								menuLabel={ __( 'Font' ) }
								controls={ [
									{
										title: __( 'Poiret One' ),
										icon: 'editor-textcolor',
										onClick: () => onChangeFont( 'poiret-one' ),
									},
									{
										title: __( 'Lobster Two' ),
										icon: 'editor-textcolor',
										onClick: () => onChangeFont( 'lobster-two' ),
									},
									{
										title: __( 'Raleway' ),
										icon: 'editor-textcolor',
										onClick: () => onChangeFont( 'raleway' ),
									},
									{
										title: __( 'Titillium Web' ),
										icon: 'editor-textcolor',
										onClick: () => onChangeFont( 'titillium-web' ),
									},
									{
										title: __( 'Indie Flower' ),
										icon: 'editor-textcolor',
										onClick: () => onChangeFont( 'indie-flower' ),
									},
								] }
							/>
						</Toolbar>
					</BlockControls>
				),
				<div className={ props.className } key={ props.className }>
					<div
						id="tld-actt-tweet-container"
						className={ classnames(
							boxTheme,
							fontStyle,
							{ animated: !! props.focus && ( props.attributes.animaion !== 'none' ) },
							animation,
							{ infinite: !! props.focus && ( props.attributes.infinite ) },
						) }
						style={ animationStyle }
					>
						<Editable
							tagName="p"
							placeholder={ __( 'Your Tweet' ) }
							onChange={ onChangeTweetMask }
							value={ props.attributes.tweetmask }
							focus={ props.focus }
							formattingControls={ [] }
						/>
						<div
							className={ classnames(
								'tld-actt-tweet-text',
								{ 'tld-actt-white-btn-text': ( props.attributes.theme === 'bbutton' ) },
								{ 'tld-actt-btn-full': ( props.attributes.theme === 'bbutton' ) },
							) }
						>
							<a className={ ( props.attributes.theme !== 'bbutton' ) ? 'tld-actt-btn-default' : '' } href={ 'https://twitter.com/intent/tweet?text=' + ( props.attributes.tweet !== undefined ? props.attributes.tweet : props.attributes.tweetmask ) }>
								<span>{ props.attributes.button }</span>
								<span className="icon-twitter"></span>
							</a>
						</div>
					</div>
				</div>,
			];
		},
		save() {
			// Rendering in PHP
			return null;
		},
	},
);
