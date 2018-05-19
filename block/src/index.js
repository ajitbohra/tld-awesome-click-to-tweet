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
const { Component, Fragment } = wp.element;
const { registerBlockType } = wp.blocks;
const { RichText } = wp.editor;

/**
 * Register block
 */
export default registerBlockType(
	'thelonedev/clicktotweet',
	{
		title: __('Click to Tweet'),
		category: 'widgets',
		icon: 'twitter',
		keywords: [
			__('Twitter'),
			__('Tweet'),
		],
		attributes: blockAttributes,
		edit: props => {
			const onChangeTweetMask = value => {
				props.setAttributes({ tweetmask: value });
			};

			const animation = props.attributes.animation === 'none' ? '' : props.attributes.animation;

			return (
				<Fragment>
					<Inspector {...{ ...props }} />
					<Controls {... { ...props }} />
					<div className={props.className}>
						<div
							id="tld-actt-tweet-container"
							className={classnames(
								`tld-actt-${props.attributes.theme}`,
								props.attributes.font,
								{ animated: animation },
								animation,
								{ infinite: props.attributes.infinite },
							)}
							style={{ 'animation-duration': `${props.attributes.duration}s`, 'animation-delay': `${props.attributes.delay}s` }}
						>
							<RichText
								format="string"
								tagName="p"
								placeholder={__('Your Tweet')}
								onChange={onChangeTweetMask}
								value={props.attributes.tweetmask}
								formattingControls={[]}
							/>
							<div
								className={classnames(
									'tld-actt-tweet-text',
									{ 'tld-actt-white-btn-text': (props.attributes.theme === 'bbutton') },
									{ 'tld-actt-btn-full': (props.attributes.theme === 'bbutton') },
								)}
							>
								<a className={(props.attributes.theme !== 'bbutton') ? 'tld-actt-btn-default' : ''}
									target="_blank"
									href={`https://twitter.com/intent/tweet?text=${(props.attributes.tweet !== undefined ? props.attributes.tweet : props.attributes.tweetmask)}`}>
									<span>{props.attributes.button}</span>
									<span className="icon-twitter"></span>
								</a>
							</div>
						</div>
					</div>
				</Fragment>
			);
		},
		save() {
			// Server side rendering
			return null;
		},
	},
);
