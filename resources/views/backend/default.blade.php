<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    @stack('meta')

    <link href="{{ URL::asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/css/bootstrap-theme.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/css/elegant-icons-style.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('backend/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('backend/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('backend/assets/fullcalendar/fullcalendar/fullcalendar.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ URL::asset('backend/css/owl.carousel.css') }}" type="text/css">
    <link href="{{ URL::asset('backend/css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('backend/css/fullcalendar.css') }}">
    <link href="{{ URL::asset('backend/css/widgets.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/css/style-responsive.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('backend/css/xcharts.min.css') }}" rel=" stylesheet">
    <link href="{{ URL::asset('backend/css/jquery-ui-1.10.4.min.css') }}" rel="stylesheet">

    @stack('css')
    <link href="{{ URL::asset('backend/css/style.css') }}" rel="stylesheet">

    @stack('title')
    
</head>

<body>

    <section id="container" class="">
        @include('backend.partials.header')
        @include('backend.partials.sidebar')

        <section id="main-content">
            @yield('content')

            @include('backend.partials.footer')
        </section>
    </section>

    <script src="{{ URL::asset('backend/js/jquery.js') }}"></script>
    <script src="{{ URL::asset('backend/js/jquery-ui-1.10.4.min.js') }}"></script>
    <script src="{{ URL::asset('backend/js/jquery-1.8.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('backend/js/jquery-ui-1.9.2.custom.min.js') }}"></script>
    <script src="{{ URL::asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('backend/js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ URL::asset('backend/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('backend/js/owl.carousel.js') }}"></script>
    <script src="{{ URL::asset('backend/js/jquery.sparkline.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('backend/js/fullcalendar.min.js') }}"></script>
    <script src="{{ URL::asset('backend/js/calendar-custom.js') }}"></script>
    <script src="{{ URL::asset('backend/js/jquery.rateit.min.js') }}"></script>
    <script src="{{ URL::asset('backend/js/jquery.customSelect.min.js') }}"></script>
    <script src="{{ URL::asset('backend/js/scripts.js') }}"></script>
    <script src="{{ URL::asset('backend/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ URL::asset('backend/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ URL::asset('backend/js/xcharts.min.js') }}"></script>
    <script src="{{ URL::asset('backend/js/jquery.autosize.min.js') }}"></script>
    <script src="{{ URL::asset('backend/js/jquery.placeholder.min.js') }}"></script>
    <script src="{{ URL::asset('backend/js/gdp-data.js') }}"></script>
    <script src="{{ URL::asset('backend/js/morris.min.js') }}"></script>
    <script src="{{ URL::asset('backend/js/sparklines.js') }}"></script>
    <script src="{{ URL::asset('backend/js/charts.js') }}"></script>
    <script src="{{ URL::asset('backend/js/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ URL::asset('assets/jquery-knob/js/jquery.knob.js') }}"></script>
    <script src="{{ URL::asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
    <script src="{{ URL::asset('assets/fullcalendar/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ URL::asset('assets/chart-master/Chart.js') }}"></script>

    @stack('script')
    <script>
      //knob
      $(function() {
        $(".knob").knob({
          'draw': function() {
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
        $("#owl-slider").owlCarousel({
          navigation: true,
          slideSpeed: 300,
          paginationSpeed: 400,
          singleItem: true

        });
      });

      //custom select box

      $(function() {
        $('select.styled').customSelect();
      });

      /* ---------- Map ---------- */
      $(function() {
        $('#map').vectorMap({
          map: 'world_mill_en',
          series: {
            regions: [{
              values: gdpData,
              scale: ['#000', '#000'],
              normalizeFunction: 'polynomial'
            }]
          },
          backgroundColor: '#eef3f7',
          onLabelShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });
    </script>

</body>

</html>
