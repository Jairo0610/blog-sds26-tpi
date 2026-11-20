import './bootstrap';

document.querySelectorAll('[data-toggle-password]').forEach((button) => {
    const input = document.getElementById(button.dataset.togglePassword);
    if (!input) return;

    button.addEventListener('click', () => {
        const visible = input.type === 'text';
        input.type = visible ? 'password' : 'text';
        button.querySelector('[data-eye="show"]')?.classList.toggle('hidden', !visible);
        button.querySelector('[data-eye="hide"]')?.classList.toggle('hidden', visible);
    });
});

