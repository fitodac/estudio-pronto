// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
	app: {
		head: {
			title: 'Estudio Pronto',
			meta: [
				{ name: 'viewport', content: 'width=device-width, initial-scale=1' }
			],
			link: [
				// favicon
				{
					rel: 'icon',
					type: 'image/png',
					href: '/favicon-16x16.png',
					sizes: '16x16'
				},
				{
					rel: 'icon',
					type: 'image/png',
					href: '/favicon-32x32.png',
					sizes: '32x32'
				},
				{ 
					rel: 'apple-touch-icon',
					href: '/apple-touch-icon.png',
					sizes: '180x180'
				},
				{
					rel: 'manifest',
					href: '/site.webmanifest'
				}
			],
		}
	},

	css: [
		'~/assets/css/main.scss'
	],


	modules: [
		'@nuxtjs/tailwindcss',
		'@pinia/nuxt'
	],

	plugins: [
		'~/plugins/element-plus.js'
	],


	tailwindcss: {
		cssPath: '~/assets/css/tailwind.css',
		configPath: 'tailwind.config',
		exposeConfig: false,
		// config: {},
		injectPosition: 0,
		viewer: true,
	}

})