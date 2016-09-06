// declare a new module called 'myApp', and make it require the `ng-admin` module as a dependency
var myApp = angular.module('myApp', ['ng-admin']);
// declare a function to run when the module bootstraps (during the 'config' phase)
myApp
    .config(['RestangularProvider', function (RestangularProvider) {
    // The URL of the API endpoint
    //RestangularProvider.setBaseUrl('http://localhost');

    // JSON-LD @id support
    RestangularProvider.setRestangularFields({
        id: '@id'
    });
    //RestangularProvider.setSelfLinkAbsoluteUrl(false);

    // Hydra collections support
    RestangularProvider.addResponseInterceptor(function (data, operation) {
        // Remove trailing slash to make Restangular working
        function populateHref(data) {
            if (data['@id']) {
                data.href = data['@id'].substring(1);
                data.id = data['@id'].substring(data['@id'].length -1);
            }
        }

        // Populate href property for the collection
        populateHref(data);

        if ('getList' === operation) {
            var collectionResponse = data['hydra:member'];
            collectionResponse.metadata = {};

            // Put metadata in a property of the collection
            angular.forEach(data, function (value, key) {
                if ('hydra:member' !== key) {
                    collectionResponse.metadata[key] = value;
                }
            });

            // Populate href property for all elements of the collection
            angular.forEach(collectionResponse, function (value) {
                populateHref(value);
            });

            console.table(collectionResponse);
            return collectionResponse;
        }

        return data;
    });
}])
    .config(['NgAdminConfigurationProvider', function (nga) {
    // create an admin application
    var admin = nga.application('Julien Babigeon - Admin')
        .baseApiUrl('http://localhost:8000/');

    var image = nga.entity('image_objects');

    image.listView().fields([
        nga.field('id'),
        nga.field('name'),
        nga.field('description'),
        nga.field('contentUrl', 'file').uploadInformation({ 'url': 'http://localhost:8000/upload', 'apifilename': 'name' }),
        nga.field('datePublished')
    ]);

    image.showView().fields([
        nga.field('name'),
        nga.field('description'),
        nga.field('contentUrl', 'file').uploadInformation({ 'url': 'http://localhost:8000/upload', 'apifilename': 'name' }),
        //nga.field('contentUrl'),
        nga.field('datePublished')
    ]);

    image.creationView().fields([
        nga.field('name'),
        nga.field('description'),
        nga.field('datePublished')
    ]);

    //image.editionView().fields(image.creationView().fields());

    admin.addEntity(image);

    nga.configure(admin);
}]);