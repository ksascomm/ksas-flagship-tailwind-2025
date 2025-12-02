const { NoEmitOnErrorsPlugin } = require("webpack");
/** @type {import('tailwindcss').Config} */
module.exports = {
  theme: {
    extend: {
		screens: {
		// Custom height-based screen (e.g., hide when viewport height is under 750px or 1000px)
		'short': { 
			'raw': '(max-height: 750px)' 
		},
		'medium': {
			'raw': '(max-height: 1000px)' 
		}
		},
      typography: ({ theme }) => ({
        DEFAULT: {
          css: [
            {
              color: "#31261D",
              lineHeight: "1.6",
              "--tw-prose-body": "#31261D",
              "--tw-prose-bullets": "#005EB8",
              "--tw-prose-headings": "#31261D",
              "--tw-prose-links": "#005EB8",
              "--tw-prose-bold": "#31261D",
              "--tw-prose-code": "#31261D",
              "--tw-prose-pre-code": "#31261D",
              "--tw-prose-pre-bg": "#857d7dff",
              "--tw-prose-quotes": "#002d72",
              "--tw-prose-counters": "31261D",
              "ul > li::before": {
                backgroundColor: "#31261D",
              },
              "ol > li::before": {
                display: "none",
                backgroundColor: "#fefefe",
                color: "#31261D",
              },
              "ol > li": {
                display: "list-item",
              },
              "ul > li": {
                display: "list-item",
              },
              h1: {
                marginBottom: "0rem",
                fontSize: "4rem",
                fontWeight: "700",
                fontFamily: "robotoslab-bold, Georgia, serif",
              },
              h2: {
                marginTop: "0.5rem",
                marginBottom: "0.5rem",
                maxWidth: "90ch",
                fontSize: "2rem",
                fontWeight: "700",
                fontFamily: "worksans-bold, system-ui, BlinkMacSystemFont, -apple-system, Segoe UI, sans-serif",
              },
              h3: {
                marginTop: "0.5rem",
                marginBottom: "0.5rem",
                fontSize: "1.6rem",
                fontWeight: "700",
                fontFamily: "worksans-bold, system-ui, BlinkMacSystemFont, -apple-system, Segoe UI, sans-serif",
              },
              h4: {
                marginTop: "0.5rem",
                marginBottom: "0.5rem",
                fontSize: "1.25rem",
                fontWeight: "700",
                fontFamily: "worksans-bold, system-ui, BlinkMacSystemFont, -apple-system, Segoe UI, sans-serif",
              },
              h5: {
                fontWeight: "700",
                fontFamily: "worksans-bold, system-ui, BlinkMacSystemFont, -apple-system, Segoe UI, sans-serif",
              },
              p: {
                marginTop: "1rem",
                marginBottom: "1rem",
				letterSpacing:"-0.03rem",
				fontWeight: 400,
              },
              li: {
                maxWidth: "90ch",
                marginTop: "0rem",
                marginBottom: ".25rem",
				fontWeight: 400,
              },
              a: {
                textDecoration: "none",
                transition: "none",
				fontWeight: 400,
              },
              strong: {
                fontFamily: "worksans-bold, system-ui",
                fontWeight: 700,
              },
              "a strong": {
                color: "inherit",
              },
              table: {
                fontSize: "1rem",
                marginTop: ".5rem",
                marginBottom: ".5rem",
              },
              thead: {
                color: "#31261D",
              },
              img: {
                marginTop: "1rem",
                marginBottom: "1rem",
              },
              hr: {
                marginTop: "1.25rem",
                marginBottom: "1.25rem",
                borderColor: "#bfccd9",
              },
              figure: {
                marginTop: ".5rem",
                marginBottom: ".5rem",
              },
              small: {
                fontSize: "75%",
              },
              blockquote: {
                borderLeftColor: "#f8f8f8",
                backgroundColor: "#f8f8f8",
              },
              "blockquote p:first-of-type::before": {
                content: "none",
              },
            },
          ],
        },
		sm: {
          css: {
			h2: {
              marginTop: theme('spacing.2'), // e.g. mt-2 (.5rem)
			  marginBottom: theme('spacing.2'),
			  fontSize: "1.875rem",
            },
			fontSize: "1.125rem",
            maxWidth: '100%', // override on small screens
          },
        },
        lg: {
          css: {
			h2: {
              marginTop: theme('spacing.2'), // e.g. mt-2 (.5rem)
			  marginBottom: theme('spacing.2'),
			  fontSize: "2rem",
            },
			h3: {
        		marginTop: "0.5rem",
            	marginBottom: "0.5rem",
				fontSize: "1.6rem",
			},
			h4: {
        		marginTop: "0.5rem",
            	marginBottom: "0.5rem",
				fontSize: "1.25rem",
			},
			fontSize: "1.25rem",
            maxWidth: '75ch', // increase on large screens
          },
        },
      }),
    },
	variants: {
		extend: {
		typography: ['responsive'],
		},
	},	
	},
	plugins: [require('@tailwindcss/typography')],
};
