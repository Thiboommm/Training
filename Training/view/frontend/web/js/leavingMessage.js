define([
    'jquery',
    'uiComponent'
], function ($, Component) {
    'use strict';

    return Component.extend({
        initialize: function () {
            this._super();
            window.onbeforeunload = function () {
                return 'Are you sure you want to leave?';
            };
        }
    });
});
