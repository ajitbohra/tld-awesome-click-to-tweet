/**
 * Block dependencies
 */
import classnames from 'classnames';
import blockAttributes from './attributes';
import Inspector from './inspector';
import Controls from './controls';
import './editor.scss'; 

/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;
const {
	registerBlockType,
	Editable,
} = wp.blocks;

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
		attributes: blockAttributes,
		edit: props => {

			// Events for Toolbar & Inspector controls
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
				props.setAttributes( { animation: value } );
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

			const animation = !!props.focus && ((props.attributes.animation === 'none') ? '' : props.attributes.animation);

			return [

				// Inspector
				!! props.focus && (
					<Inspector 
						{ ...{ onChangeTweet, onChangeButton, onChangeAnimation, onChangeDuration, onChangeDelay, toggleInfinite,...props} }
					/>
				),

				// Toolbar
				!! props.focus && (
					<Controls {... { onChangeTheme, onChangeFont,...props }} />
				),

				// Edit UI
				<div className={ props.className } key={ props.className }>
					<div
						id="tld-actt-tweet-container"
						className={ classnames(
							`tld-actt-${props.attributes.theme}`,
							props.attributes.font,
							{ animated: !! props.focus && ( props.attributes.animation !== 'none' ) },
							animation,
							{ infinite: !! props.focus && ( props.attributes.infinite ) },
						) }
						style={	{ 'animation-duration': `${props.attributes.duration}s`, 'animation-delay': `${props.attributes.delay}s` } }
					>
					{ /* TODO: Update to RichText */ }
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
							<a	className={ ( props.attributes.theme !== 'bbutton' ) ? 'tld-actt-btn-default' : '' } 
								target="_blank"
							    href={ `https://twitter.com/intent/tweet?text=${( props.attributes.tweet !== undefined ? props.attributes.tweet : props.attributes.tweetmask )}` }>
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
