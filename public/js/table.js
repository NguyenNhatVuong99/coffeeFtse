// jQuery(document).ready(function($) {

//     var zindex = 10;

//     $("div.card").click(function(e) {
//         e.preventDefault();

//         var isShowing = false;

//         if ($(this).hasClass("show")) {
//             isShowing = true
//         }

//         if ($("div.cards").hasClass("showing")) {
//             // a card is already in view
//             $("div.card.show")
//                 .removeClass("show");

//             if (isShowing) {
//                 // this card was showing - reset the grid
//                 $("div.cards")
//                     .removeClass("showing");
//             } else {
//                 // this card isn't showing - get in with it
//                 $(this)
//                     .css({ zIndex: zindex })
//                     .addClass("show");

//             }

//             zindex++;

//         } else {
//             // no cards in view
//             $("div.cards")
//                 .addClass("showing");
//             $(this)
//                 .css({ zIndex: zindex })
//                 .addClass("show");

//             zindex++;
//         }

//     });
// });
(function() {

    function activateTab() {
        if (activeTab) {
            resetTab.call(activeTab);
        }
        this.parentNode.className = 'tab tab-active';
        activeTab = this;
        activePanel = document.getElementById(activeTab.getAttribute('href').substring(1));
        activePanel.className = 'tabpanel show';
        activePanel.setAttribute('aria-expanded', true);
    }

    function resetTab() {
        activeTab.parentNode.className = 'tab';
        if (activePanel) {
            activePanel.className = 'tabpanel hide';
            activePanel.setAttribute('aria-expanded', false);
        }
    }

    var doc = document,
        tabs = doc.querySelectorAll('.tab a'),
        panels = doc.querySelectorAll('.tabpanel'),
        activeTab = tabs[0],
        activePanel;

    activateTab.call(activeTab);

    for (var i = tabs.length - 1; i >= 0; i--) {
        tabs[i].addEventListener('click', activateTab, false);
    }

})();