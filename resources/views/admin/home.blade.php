@extends('administrator::layouts.admin')

@section('header')
    @include('administrator::layouts.parts.header')
@endsection

@section('scripts')
    <script>
        var wGrid = function() {
            // Chart
            var ChartData = [];
            var getData = function() {

                var xhr = new XMLHttpRequest();

                xhr.open('GET', '/administrator/chart/data', true);

                xhr.send();

                xhr.onreadystatechange = function() {
                    if (this.readyState != 4) return;

                    if (this.status != 200) {

                        console.log( 'Error: ' + (this.status ? this.statusText : '') );
                        return;
                    }
                    if(this.responseText) {
                        ChartData = JSON.parse(this.responseText);
                        _gridExamples();
                        return false;
                    }
                }
            };
            var _gridExamples = function() {
                console.log(ChartData);
                if (typeof c3 == 'undefined') {
                    console.warn('Warning - c3.min.js is not loaded.');
                    return;
                }
                // Define charts elements
                var grid_lines_element = document.getElementById('c3-grid-lines');

                // Grid lines
                if(grid_lines_element) {

                    // Generate chart
                    var grid_lines = c3.generate({
                        bindto: grid_lines_element,
                        size: { height: 400 },
                        color: {
                            pattern: ['#2196F3']
                        },
                        data: {
                            columns: [
                                ChartData.chartData
                            ]
                        },
                        axis: {
                            x: {
                                type: 'category',
                                categories: ChartData.chartCategories
                            }
                        },
                        grid: {
                            x: {
                                show: true
                            },
                            y: {
                                show: true
                            }
                        }
                    });

                    // Resize chart on sidebar width change
                    $('.sidebar-control').on('click', function() {
                        grid_lines.resize();
                    });
                }

            };

            //
            // Return objects assigned to module
            //
            return {
                init: function() {
                    getData();
                }
            }
        }();

        // Initialize module
        // ------------------------------
        document.addEventListener('DOMContentLoaded', function() {
            wGrid.init();
        });
    </script>
@endsection

@section('navigation')
    {!! $sidebar !!}
@endsection

@section('content')
    {!! $content !!}
@endsection

@section('footer')
    @include('administrator::layouts.parts.footer')
@endsection