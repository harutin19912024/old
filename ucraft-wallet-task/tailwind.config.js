const defaultColors = require('tailwindcss/colors');

module.exports = {
    content: [
        "./app/Http/**/*.php",
        // "./config/*.php",
        "./node_modules/@ryangjchandler/alpine-tooltip/dist/*.js",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
        './vendor/filament/forms/**/*.blade.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/wire-elements/modal/src/ModalComponent.php',
    ],

    theme: {
        colors: {
            // Tailwind colors
            'gray-100': defaultColors.gray[100],
            'gray-500': defaultColors.gray[500],
            'transparent': defaultColors.transparent,

            // Main theme colors
            'primary': 'var(--primary-color)',
            'secondary-purple': '#5A46CE',
            'secondary-yellow': '#FFBE41',
            'secondary-dark-purple': '#584B63',
            'white': '#FFFFFF',
            'secondary-white': '#FFFFFF', // TODO: rename all occurrences to white and remove this?
            // Text colors
            'default-text': '#000000',
            'alternative-text': '#121212',
            'disabled-text': '#B0B5C9',
            'cta-text': '#0F47AF',
            'pink-dark': '#EB0046',
            'error-text': '#B10D01',
            'warning-text': '#A74B00',
            'success-text': '#016704',
            // Backgrounds
            'light-grey': '#F4F4F4',
            'light-grey-alternative': '#F9F9FA',
            'dark-grey': '#363243',
            'disabled-button': '#D3D4E2',
            // Other colors
            'divider': '#ECECEC',
            'error': '#E91B0C',
            'info': '#2196F3',
            'warning': '#FF9900',
            'success': '#4CAF50',
            'topbar': '#F9F9F9',
            'price-free': '#499C4D',
            'platinum-membership': '#677FD3',
            'discount-badge': '#EA0000',
            'facebook-blue': '#1877F2',
            'input': '#6A718D',
            'checked-input': '#24292E',
            'slider-rail': '#EFEFEF',
            'filter-bar': '#F3F3F4',
            'my-course-label': '#0374CE',
            'order-not-paid': '#ff99001a',
            'order-paid': '#4caf501a',
            'black-alternative': '#333333',
            // Notifications backgrounds
            'notification-error': '#FFFAFA',
            'notification-warning': '#FFFDF0',
            'notification-info': '#F7FBFF',
            'notification-success': '#F8FFF8',
        },

        extend: {
            boxShadow: {
                'main-box-shadow': '4px 7px 22px rgba(46, 61, 141, 0.11)',
                'hover-box-shadow': '1px 1px 7px rgba(46, 61, 141, 0.14)',
                'order-card-shadow': '3px 5px 18px rgba(46, 61, 141, 0.12)',
                // membership page
                'button-box-shadow': '2px 4px 12px rgba(46, 61, 141, 0.12)',
                'hover-button-box-shadow': '1px 1px 7px rgba(46, 61, 141, 0.14)',
                'membership-offer-shadow': '4px 7px 20px rgba(46, 61, 141, 0.19)',
            },

            screens: {
                'header-breakpoint': '1110px',
                'blog-section-breakpoint': '1070px',
                'featured-teaser-card-breakpoint': '950px',
                'bookmark-page-breakpoint': '910px',
                'cart-item-breakpoint': '870px',
                'lector-list-breakpoint': '820px',
                'my-course-card-breakpoint': '670px',
                'featured-teaser-card-mobile-breakpoint': '490px',
                'training-navigation-breakpoint': '440px',
                'input-breakpoint': '420px',
            },

            fontSize: {
                'heading-h1': [
                    '80px', {
                        letterSpacing: '-1.5px',
                        lineHeight: '92px',
                    }
                ],
                'heading-h2': [
                    '60px', {
                        letterSpacing: '-0.5px',
                        lineHeight: '72px',
                    }
                ],
                'heading-h3': [
                    '48px', {
                        lineHeight: '56px',
                    }
                ],
                'heading-h4': [
                    '34px', {
                        lineHeight: '42px',
                        letterSpacing: '0.25px',
                    }
                ],
                'heading-h5': [
                    '24px', {
                        lineHeight: '32px',
                    }
                ],
                'heading-h6': [
                    '20px', {
                        lineHeight: '24px',
                        letterSpacing: '0.15px',
                    }
                ],
                'subtitle-1': [
                    '16px', {
                        lineHeight: '22px',
                        letterSpacing: '0.15px',
                    },
                ],
                'subtitle-2': [
                    '14px', {
                        lineHeight: '20px',
                        letterSpacing: '0.1px',
                    },
                ],
                'body-1': [
                    '16px', {
                        lineHeight: '24px',
                        letterSpacing: '0.12px',
                    },
                ],
                'body-2': [
                    '14px', {
                        lineHeight: '21px',
                        letterSpacing: '0.15px',
                    },
                ],
                'button-l': [
                    '18px', {
                        lineHeight: '26px',
                        letterSpacing: '0.46px',
                    },
                ],
                'button-m': [
                    '15px', {
                        lineHeight: '24px',
                        letterSpacing: '0.46px',
                    },
                ],
                'button-s': [
                    '14px', {
                        lineHeight: '22px',
                        letterSpacing: '0.46px',
                    },
                ],
                'caption': [
                    '12px', {
                        lineHeight: '17px',
                        letterSpacing: '0.15px',
                    },
                ],
                'overline': [
                    '12px', {
                        lineHeight: '18px',
                        letterSpacing: '0.3px',
                    },
                ],
                'input-label': [
                    '12px', {
                        lineHeight: '12px',
                        letterSpacing: '0.15px',
                    },
                ],
                'helper-text': [
                    '12px', {
                        lineHeight: '16px',
                        letterSpacing: '0.15px',
                    },
                ],
                'input-text': [
                    '16px', {
                        lineHeight: '24px',
                        letterSpacing: '0.15px',
                    },
                ],
                'tooltip': [
                    '10px', {
                        lineHeight: '14px',
                        letterSpacing: '0.15px',
                    },
                ],
                'price': [
                    '24px', {
                        lineHeight: '24px',
                    },
                ],
            },
            fontFamily: {
                'primary': ['"Baloo 2"', 'sans-serif'],
                'secondary': ['Poppins', 'sans-serif'],
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
    ],

    corePlugins: {
        container: false,
    }
};
