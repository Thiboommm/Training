define([
    'jquery',
    'ko'
], function ($, ko) {
    'use strict';

    return function (Component) {
        return Component.extend({
            initialize: function () {
                this._super();
                this.shouldShowMessage = ko.observable(false);
            },

            combineAction: function () {
                this.toggleMessage();
                this.newConsoleLog();
            },

            toggleMessage: function () {
                this.shouldShowMessage(!this.shouldShowMessage());
            },

            newConsoleLog: function () {
                console.log('Custom log message from the mixin');
            }
        });
    };
});
