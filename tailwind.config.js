/** @type {import('tailwindcss').Config} */
module.exports = {
	content: ["./resources/**/*.{twig,html,js,ts,jsx,tsx}"],
	theme: {
		extend: {},
	},
	plugins: [require("@tailwindcss/typography")],
};
