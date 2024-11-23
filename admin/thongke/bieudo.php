<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Biểu đồ</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Biểu đồ</h4>
        </div>
        <div class="card-body">

            <div id="myChart" style="width:100%;  height:600px; ">
            </div>
                <script>
                    google.charts.load('current', { 'packages': ['corechart'] });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        const data = google.visualization.arrayToDataTable([
                            ['Tên', 'Số liệu'],
                            <?php 
                            $tongdm = count($listthongke);
                            $i =1;

                            foreach ($listthongke as $thongke) {
                                extract($thongke);
                                if ($i == $tongdm) $dauphay = ""; 
                                else $dauphay = ",";
                                echo "['".$thongke['tendm']."', ".$thongke['countsp']."]". $dauphay;
                                $i+=1;

                            }

                            ?>
                        ]);

                        const options = {
                            title: 'Biểu đồ thống kê'
                        };

                        const chart = new google.visualization.PieChart(document.getElementById('myChart'));
                        chart.draw(data, options);
                    }
                </script>


        </div>
    </div>

</div>
<!--End Content -->

</div>