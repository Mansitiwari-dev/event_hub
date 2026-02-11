// Event Hub - frontend helpers
(function(){
    'use strict';

    // Modal helper
    window.EH = window.EH || {};

    EH.openModal = function(id){
        const el = document.getElementById(id);
        if(!el) return;
        el.classList.add('show');
    }

    EH.closeModal = function(id){
        const el = document.getElementById(id);
        if(!el) return;
        el.classList.remove('show');
    }

    // Simple typing indicator: toggles .pulse on element
    EH.typingIndicator = function(el, enable){
        if(!el) return;
        if(enable) el.classList.add('pulse'); else el.classList.remove('pulse');
    }

    // Slide-in on scroll
    function onScrollAnimate(){
        document.querySelectorAll('.slide-into-view').forEach(function(el){
            const rect = el.getBoundingClientRect();
            if(rect.top < (window.innerHeight - 80)){
                el.classList.add('slide-in');
            }
        });
    }

    window.addEventListener('scroll', onScrollAnimate);
    window.addEventListener('load', onScrollAnimate);

    // Fetch wrapper with CSRF
    window.EH.fetch = function(url, options){
        options = options || {};
        options.headers = options.headers || {};
        options.headers['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
        return fetch(url, options);
    }

    // Simple helper to toggle classes
    EH.toggleClass = function(el, cls){ if(!el) return; el.classList.toggle(cls); };

})();
