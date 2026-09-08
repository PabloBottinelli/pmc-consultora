(() => {
    const toggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.main-nav');
    const backdrop = document.querySelector('.menu-backdrop');

    if (toggle && nav) {
        const closeMenu = () => {
            nav.classList.remove('open');
            document.body.classList.remove('menu-open');
            toggle.setAttribute('aria-expanded', 'false');
            toggle.setAttribute('aria-label', 'Abrir menú');
        };

        if (backdrop) {
            backdrop.addEventListener('click', closeMenu);
        }

        toggle.addEventListener('click', () => {
            const open = nav.classList.toggle('open');
            document.body.classList.toggle('menu-open', open);
            toggle.setAttribute('aria-expanded', String(open));
            toggle.setAttribute('aria-label', open ? 'Cerrar menú' : 'Abrir menú');
        });

        nav.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMenu));
    }

    // Preselecciona el servicio cuando el usuario llega al formulario desde una tarjeta.
    const serviceSelect = document.getElementById('servicio');
    document.querySelectorAll('[data-service]').forEach(link => {
        link.addEventListener('click', () => {
            if (!serviceSelect) return;
            const service = link.dataset.service;
            const option = [...serviceSelect.options].find(opt => opt.value === service);
            if (option) serviceSelect.value = service;
        });
    });

    const form = document.getElementById('contactForm');
    const email = document.getElementById('mail');
    const phone = document.getElementById('celular');
    const formMsg = document.getElementById('formMsg');

    if (form) {
        form.addEventListener('submit', (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                form.reportValidity();
                return;
            }

            if (!email.value.trim() && !phone.value.trim()) {
                event.preventDefault();
                phone.setCustomValidity('Ingresá un email o un teléfono para que podamos responderte.');
                phone.reportValidity();
            }
        });

        email.addEventListener('input', () => {
            phone.setCustomValidity('');
        });

        phone.addEventListener('input', () => {
            phone.value = phone.value.replace(/[^0-9+\s()-]/g, '');
            phone.setCustomValidity('');
        });
    }

    const params = new URLSearchParams(window.location.search);
    const formStatus = params.get('form');

    if (formMsg && formStatus) {
        if (formStatus === 'ok') {
            formMsg.textContent = 'Tu consulta fue enviada. Te responderemos a la brevedad.';
            formMsg.className = 'form-message success';
            if (typeof gtag_report_formulario === 'function') {
                gtag_report_formulario();
            }
        } else if (formStatus === 'contacto') {
            formMsg.textContent = 'Ingresá al menos un email o un teléfono válido.';
            formMsg.className = 'form-message error';
        } else if (formStatus === 'mail-invalido') {
            formMsg.textContent = 'Revisá el email ingresado.';
            formMsg.className = 'form-message error';
        } else {
            formMsg.textContent = 'No pudimos enviar la consulta. Probá nuevamente o escribinos por WhatsApp.';
            formMsg.className = 'form-message error';
        }

        // Limpia ?form=... para que una recarga no vuelva a contabilizar la conversión.
        const cleanUrl = window.location.pathname + '#contacto';
        window.history.replaceState({}, document.title, cleanUrl);
    }
})();
