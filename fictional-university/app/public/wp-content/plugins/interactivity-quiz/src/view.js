/**
 * WordPress dependencies
 */
import { store, getContext } from '@wordpress/interactivity';

const { state } = store( 'create-block', {
	state: {
		get themeText() {
			return state.isDark ? state.darkText : state.lightText;
		},
	},
	actions: {
		guessAttempt(){
			const context=getContext();
			if(!context.solved){
				if(context.index === context.correctAnswer){
					context.showCongrats = true;
					context.solved = true;	
				} else{
					context.showSorry = true;
					setTimeout(()=>{
						context.showSorry =false;
					}, 2600);
				}
			}
		},
		buttonHandler:()=>{
			const context = getContext();
			context.clickCount++;
		},
		toggleOpen() {
			const context = getContext();
			context.isOpen = ! context.isOpen;
		},
		toggleTheme() {
			state.isDark = ! state.isDark;
		},
	},
	callbacks: {
		logIsOpen: () => {
			const { isOpen } = getContext();
			// Log the value of `isOpen` each time it changes.
			console.log( `Is open: ${ isOpen }` );
		},
	},
} );
