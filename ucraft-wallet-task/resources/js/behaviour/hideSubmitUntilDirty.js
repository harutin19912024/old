let forms = document.querySelectorAll('[data-behaviour="hideSubmitUntilDirty"]');

forms.forEach(form => {
    form.addEventListener('input', e => {
        let submit = form.querySelector('[data-submit]');

        submit.style.display = 'inline-flex';
    });
});
