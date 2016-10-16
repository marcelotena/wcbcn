var home = {
    bindings: {
        list: '<'
    },
    templateUrl: 'wp-content/themes/wp_ng_spa/assets/js/components/home/home.component.html',
    controller: function(SeriesService) {
        var ctrl = this;
        var currentPage = 2;
        var pageLimit = 5;
        ctrl.busy = false;

        ctrl.loadMorePages = function () {

            if (currentPage <= pageLimit) {
                ctrl.busy = true;

                SeriesService
                    .getSeries(currentPage)
                    .then(function(response) {
                        currentPage++;
                        pageLimit = response[0].totalPages;
                        ctrl.list = ctrl.list.concat(response);
                        ctrl.busy = false;
                    });

            }

        };
    }
};

angular
    .module('home')
    .component('home', home)
    .config(function ($stateProvider, $urlRouterProvider, $locationProvider) {

        $locationProvider.html5Mode(true);

        $stateProvider
            .state('home', {
                url: '/',
                component: 'home',
                resolve: {
                    list: function(SeriesService) {
                        return SeriesService.getSeries();
                    }
                }
            });

        $urlRouterProvider.otherwise('/');
    });