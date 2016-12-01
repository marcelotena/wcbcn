var detail = {
    bindings: {
        serie: '<'
    },
    controller: function ($state) {

    },
    templateUrl: 'wp-content/themes/wcbcn/assets/js/components/detail/detail.component.html'
};

angular
    .module('detail')
    .component('detail', detail)
    .config(function ($stateProvider, $urlRouterProvider, $locationProvider) {

        $locationProvider.html5Mode(true);

        $stateProvider
            .state('detail', {
                url: '/series/:slug',
                component: 'detail',
                params: {
                    slug: null
                },
                resolve: {
                    serie: function (SeriesService, $transition$) {
                        var params = $transition$.params().slug;
                        console.log(params);
                        return SeriesService.getSerieBySlug(params);
                    }
                }
            });

        $urlRouterProvider.otherwise('/');
    });