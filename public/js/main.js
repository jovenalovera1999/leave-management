/**
* Template Name: iPortfolio - v3.6.0
* Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function () {
    "use strict";

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    }

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        let selectEl = select(el, all)
        if (selectEl) {
            if (all) {
                selectEl.forEach(e => e.addEventListener(type, listener))
            } else {
                selectEl.addEventListener(type, listener)
            }
        }
    }

    /**
     * Easy on scroll event listener 
     */
    const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener)
    }

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select('#navbar .scrollto', true)
    const navbarlinksActive = () => {
        let position = window.scrollY + 200
        navbarlinks.forEach(navbarlink => {
            if (!navbarlink.hash) return
            let section = select(navbarlink.hash)
            if (!section) return
            if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                navbarlink.classList.add('active')
            } else {
                navbarlink.classList.remove('active')
            }
        })
    }
    window.addEventListener('load', navbarlinksActive)
    onscroll(document, navbarlinksActive)

    /**
     * Scrolls to an element with header offset
     */
    const scrollto = (el) => {
        let elementPos = select(el).offsetTop
        window.scrollTo({
            top: elementPos,
            behavior: 'smooth'
        })
    }

    /**
     * Back to top button
     */
    let backtotop = select('.back-to-top')
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add('active')
            } else {
                backtotop.classList.remove('active')
            }
        }
        window.addEventListener('load', toggleBacktotop)
        onscroll(document, toggleBacktotop)
    }

    /**
     * Mobile nav toggle
     */
    on('click', '.mobile-nav-toggle', function (e) {
        select('body').classList.toggle('mobile-nav-active')
        this.classList.toggle('bi-list')
        this.classList.toggle('bi-x')
    })

    /**
     * Scrool with ofset on links with a class name .scrollto
     */
    on('click', '.scrollto', function (e) {
        if (select(this.hash)) {
            e.preventDefault()

            let body = select('body')
            if (body.classList.contains('mobile-nav-active')) {
                body.classList.remove('mobile-nav-active')
                let navbarToggle = select('.mobile-nav-toggle')
                navbarToggle.classList.toggle('bi-list')
                navbarToggle.classList.toggle('bi-x')
            }
            scrollto(this.hash)
        }
    }, true)

    /**
     * Scroll with ofset on page load with hash links in the url
     */
    window.addEventListener('load', () => {
        if (window.location.hash) {
            if (select(window.location.hash)) {
                scrollto(window.location.hash)
            }
        }
    });

    /**
     * Animation on scroll
     */
    window.addEventListener('load', () => {
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        })
    });

})()

document.addEventListener('DOMContentLoaded', () => {
    // Toast messages
    setTimeout(() => {
        let toastSuccess = new bootstrap.Toast(document.getElementById('toast_success'));
        toastSuccess.show();

        setTimeout(() => {
            toastSuccess.hide();
        }, 2300);
    });

    setTimeout(() => {
        let toastFailed = new bootstrap.Toast(document.getElementById('toast_failed'));
        toastFailed.show();

        setTimeout(() => {
            toastFailed.hide();
        }, 2300);
    });

    // User modal
    const btnEdit = document.querySelectorAll('.btn_editUser');
    btnEdit.forEach(function (button) {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        const user = JSON.parse(xhr.responseText);

                        // Update input fields with user data and show the modal
                        document.getElementById('edit_first_name_id').value = user.first_name || '';
                        document.getElementById('edit_middle_name_id').value = user.middle_name || '';
                        document.getElementById('edit_last_name_id').value = user.last_name || '';
                        document.getElementById('edit_suffix_name_id').value = user.suffix_name || '';
                        document.getElementById('edit_age').value = user.age || '';
                        document.getElementById('edit_birth_date').value = user.birth_date || '';
                        document.getElementById('edit_gender_id').value = user.gender_id || '';
                        document.getElementById('edit_address').value = user.address || '';
                        document.getElementById('edit_contact_number').value = user.contact_number || '';
                        document.getElementById('edit_email_address').value = user.email_address || '';
                        document.getElementById('edit_username').value = user.username || '';
                        document.getElementById('edit_role_id').value = user.role_id || '';

                        // Set the action attribute of the form to include the user ID
                        document.getElementById('editUserForm').action = '/user/update/' + user.user_id;
                    } else {
                        console.error('Error fetching user data');
                    }
                }
            };

            xhr.open('GET', '/user/edit/' + id);
            xhr.send();
        });
    });

    const btnDelete = document.querySelectorAll('.btn_deleteUser');
    btnDelete.forEach(function (button) {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        const user = JSON.parse(xhr.responseText);

                        // Update input fields with user data and show the modal
                        document.getElementById('delete_first_name_id').value = user.first_name || '';
                        document.getElementById('delete_middle_name_id').value = user.middle_name || '';
                        document.getElementById('delete_last_name_id').value = user.last_name || '';
                        document.getElementById('delete_suffix_name_id').value = user.suffix_name || '';
                        document.getElementById('delete_age').value = user.age || '';
                        document.getElementById('delete_birth_date').value = user.birth_date || '';
                        document.getElementById('delete_gender_id').value = user.gender || '';
                        document.getElementById('delete_address').value = user.address || '';
                        document.getElementById('delete_contact_number').value = user.contact_number || '';
                        document.getElementById('delete_email_address').value = user.email_address || '';
                        document.getElementById('delete_username').value = user.username || '';
                        document.getElementById('delete_role_id').value = user.role || '';

                        // Set the action attribute of the form to include the user ID
                        document.getElementById('deleteUserForm').action = '/user/destroy/' + user.user_id;
                    } else {
                        console.error('Error fetching user data');
                    }
                }
            };

            xhr.open('GET', '/user/delete/' + id);
            xhr.send();
        });
    });
});