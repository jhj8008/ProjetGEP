<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Votes</div>
                    <div class="candidates">
                      <!-- Buttons to cast votes will go in here -->
                      <button type="button" class="btn btn-secondary" @click="counter += 1">Click here</button>
                      <h3 style="font-family:Lato;font-size: 15px">You clicked {{ counter }} times</h3>
                    </div>
                    
                    <!-- Our focus right now -->
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js'
    import _ from "lodash";

    export default {
        data() {
            return {
                counter: 0,
                candidates: [],
                chart: null,
            }
        },
        methods: {
            drawChart() {
              let ctx = document.getElementById("myChart");
              this.chart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: ['candidate 1', 'Candidate 2'],
                      datasets: [{
                          label: '# of Votes',
                          data: [5, 8],
                          borderWidth: 1
                      }]
                  },
                  options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                  }
              });
            },
            increment(){
                alert('Hello there');
            }
        },
        mounted() {
            this.drawChart()
        }
    }
</script>
