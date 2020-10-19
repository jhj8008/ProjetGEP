<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Votes</div>
                    <div class="candidates">
                        <ul>
                            <li v-for="(candidate, index) in candidates" :key="index"><button @click="incrementVotes(candidate.id)">{{ candidate.desc }}</button></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h3 style="font-family:Lato;font-size: 15px">{{ description }}</h3>
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
        props: ['poll_id', 'poll_desc'],
        data() {
            return {
                description: this.poll_desc, 
                candidates: [],
                chart: null,
            }
        },
        methods: {
            drawChart(descs, votes) {
              let ctx = document.getElementById("myChart");
              this.chart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: descs,
                      datasets: [{
                          label: '# of Votes',
                          data: votes,
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
            incrementVotes(candidate_id) {
                axios.post('/candidates/' + candidate_id, {})
                .then((response) => {
                    let candidates = response.data.data
                    this.drawChart(_.map(candidates, 'desc'), _.map(candidates, 'votes_count'))
                }).catch((error) => {
                    console.error(error)
                })
            }
        },
        mounted() {
            this.drawChart()
        },
        created() {
            axios.get('/polls/' + this.poll_id)
            .then((response) => {
                this.candidates = response.data.data;
                this.drawChart(_.map(this.candidates, 'desc'), _.map(this.candidates, 'votes_count'))
            }).catch((error) => {
                console.error(error)
            })
        },
    }
</script>
