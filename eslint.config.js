import js from "@eslint/js";
import globals from "globals";

const recommended = js.configs.recommended;

export default [
	{
		files: ["public/js/**/*.js"],
		...recommended,
		languageOptions: {
			...recommended.languageOptions,
			ecmaVersion: "latest",
			sourceType: "script",
			globals: globals.browser
		},
		linterOptions: {
			reportUnusedDisableDirectives: true
		}
	}
];
