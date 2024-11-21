define(
    [
        'uiComponent',
        'jquery',
        'ko'
    ],
    function (
        Component,
        $,
        ko
    ) {
        'use strict';
        return Component.extend({

            initialize: function () {
                this._super();
                this.shouldShowMessage = ko.observable(false); // Single observable for showing/hiding the message
            },

            toggleMessage: function () {
                this.shouldShowMessage(!this.shouldShowMessage()); // Toggle the observable value
            }
        });
    }
);
