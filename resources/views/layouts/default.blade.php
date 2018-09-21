<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ABProno - Pronostiqueur en paris sportifs</title>
    <link rel="icon" type="image/png" href="{{ URL::asset('img/favicon.png') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/animate.min.css') }}">
</head>

<body>

<header>
 @include('partials/navbar')
</header>

@yield('content')


@include('partials/footer')


<script src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/wow.min.js') }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script>
    Highcharts.chart('stats_reussite', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Taux de réussite pour {{ $nbAllBets}}  pronostics'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Taux',
            colorByPoint: true,
            data: [{
                name: 'Paris gagnants',
                y:   {{$bet->countBetsForResult("Gagné")}},
                sliced: true,
                color: '#2ecc71',
                selected: true
            }, {
                color: '#e74c3c',
                name: 'Paris perdants',
                y: {{$bet->countBetsForResult("Perdu")}}
            },
                {
                    color: 'orange',
                    name: 'Paris rembourser/annuler',
                    y:  {{$bet->countBetsForResult("Rembourser")}}
                }]
        }]
    });
    Highcharts.chart('stats_sport', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Sports les plus joué'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Taux',
            colorByPoint: true,
            data: [
                {
                    color: '#27ae60',
                    name: 'Football',
                    y: {{$bet->countBetsForSport("Football")}}
                },
                {
                    color: '#f1c40f',
                    name: 'Tennis',
                    y: {{$bet->countBetsForSport("Tennis")}}
                }]
        }]
    });
    Highcharts.chart('type_pari', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        }, credits: {
            enabled: false
        },
        title: {
            text: 'Types de paris'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Taux',
            colorByPoint: true,
            data: [
                { 
                    color: '#2c3e50',
                    name: 'Combiné',
                    y:  {{$bet->countBetsForType("Combiné")}}
                },
                {
                    color: '#2980b9',
                    name: 'Simple',
                    y:  {{$bet->countBetsForType("Simple")}}
                }]
        }]
    });
</script>

</body>

</html>