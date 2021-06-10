module.exports = {
    mode: 'jit',
    purge: [
        './resources/views/**/*.blade.php',
        './resources/css/**/*.css',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Open Sans', 'sans-serif'],
            },
            colors: {

            },
        }
    },
    variants: {},
    plugins: [],
};
