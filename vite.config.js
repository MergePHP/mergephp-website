module.exports = {
	build: {
		outDir: 'docs'
	},
	server: {
		port: 3000,
		open: true,
		base: './docs'
	},
	optimizeDeps: {
		include: [
		'tailwindcss'
		]
	}
}
