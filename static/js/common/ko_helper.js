ko.bindingHandlers.fadinText = {

    init: function(element, valueAccessor, allBindings, viewModel, bindingContext) {

        ko.bindingHandlers.html.init(element, valueAccessor, allBindings, viewModel, bindingContext);
        $(element).hide();

    },

    update: function(element, valueAccessor, allBindings, viewModel, bindingContext) {

        ko.bindingHandlers.html.update(element, valueAccessor, allBindings, viewModel, bindingContext);
        $(element).fadeIn(1000);

    }

};

ko.bindingHandlers.fadinImage = {
    init: function(element, valueAccessor, allBindings, viewModel, bindingContext) {
//                console.log('init')
//                console.log(element)
//                console.log(valueAccessor())

        $(element).hide();
    },

    update: function(element, valueAccessor, allBindings, viewModel, bindingContext) {
//                console.log('update')
//                console.log($(element).attr)
        $(element).attr('src',valueAccessor());

        var duration = allBindings().fadeDuration || 300
        $(element).fadeIn(duration);

    }
}

ko.bindingHandlers.slideVisible = {
    update: function (element, valueAccessor, allBindings) {
        // First get the latest data that we're bound to
        var value = valueAccessor();

        // Next, whether or not the supplied model property is observable, get its current value
        var valueUnwrapped = ko.unwrap(value);

        // Grab some more data from another binding property
        var duration = allBindings.get('slideDuration') || 400; // 400ms is default duration unless otherwise specified

        // Now manipulate the DOM element
        if (valueUnwrapped == true)
            $(element).slideDown(duration); // Make the element visible
        else
            $(element).slideUp(duration);   // Make the element invisible
    }
};

ko.bindingHandlers.fadeVisible = {

    update: function (element, valueAccessor, allBindings) {
        // First get the latest data that we're bound to
        var value = valueAccessor();

        // Next, whether or not the supplied model property is observable, get its current value
        var valueUnwrapped = ko.unwrap(value);

        // Grab some more data from another binding property
        var duration = allBindings.get('slideDuration') || 400; // 400ms is default duration unless otherwise specified

        // Now manipulate the DOM element
        if (valueUnwrapped == true)
            $(element).fadeIn(duration); // Make the element visible
        else
            $(element).fadeOut(duration);   // Make the element invisible
    }

};

ko.bindingHandlers.uniqueId = {

    init: function (element, valueAccessor) {
        var value = valueAccessor();
        element.id = value;
    },

    update : function (element, valueAccessor) {
        var value = valueAccessor();
        element.id = value;
    },
};