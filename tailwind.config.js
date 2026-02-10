// tailwind.config.js
module.exports = {
  content: [
    "./pages/**/*.{js,ts,jsx,tsx,mdx}",
    "./components/**/*.{js,ts,jsx,tsx,mdx}",
    "./app/**/*.{js,ts,jsx,tsx,mdx}",
    // '/node_modules/tippy.js/dist/tippy.css',
    // Add other relevant paths for your project, e.g.,
    // "./src/**/*.{js,ts,jsx,tsx,mdx}",
    'vendor/awcodes/filament-tiptap-editor/resources/**/*.blade.php',
    // 'vendor/awcodes/filament-tiptap-editor/resources/css/plugin.css',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
