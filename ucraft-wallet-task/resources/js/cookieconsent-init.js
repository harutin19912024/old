var cc = initCookieConsent()

cc.run({
    current_lang: 'lt',
    autoclear_cookies: true,                   // default: false
    page_scripts: true,                        // default: false

    languages: {
        'lt': {
            consent_modal: {
                description: '',
                primary_btn: {
                    text: '',
                    role: 'accept_all'              // 'accept_selected' or 'accept_all'
                },
                secondary_btn: {
                    text: '',
                    role: 'accept_necessary'        // 'settings' or 'accept_necessary'
                }
            },
            settings_modal: {
                cookie_table_headers: [],
                blocks: [
                    {toggle: {value: 'necessary', enabled: true, readonly: true}},
                    {toggle: {value: 'analytics', enabled: false, readonly: false}},
                    {toggle: {value: 'targeting', enabled: false, readonly: false}},
                ]
            }
        }
    }
})
