<template>
    <div class="container" id="btn_click">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Votes</div>
                        <div class="candidates">
                            <div class="list-group radio-list-group">
                                <div class="list-group-item" v-for="candidate in candidates" v-bind:key="candidate.id">&nbsp;<label><input @change="incrementVotes(candidate.id)" type="radio" name="radioInput" value="candidate.desc"><span class="list-group-item-text"><i class="fa fa-fw"></i> {{ candidate.desc }}</span></label></div>
                            </div>
                        </div>
                    <!-- Our focus right now -->
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
        props: ['poll_id', 'poll_desc', 'poll_candidates'],
        data() {
            return {
                description: this.poll_desc,
                candidates: this.poll_candidates,
                chart: null,
            }
        },
        methods: {
            drawChart(names, votes) {
              let ctx = document.getElementById("myChart");
              this.chart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: names,
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
                //alert('Hello !! Help')
              axios.post('/candidates/' + candidate_id, {})
              .then((response) => {
                let candidates = response.data.data
                this.drawChart(_.map(candidates, 'desc'), _.map(candidates, 'votes_count'))
              }).catch((error) => {
                  console.error(error)
              })
            }, 
            setPrice(event) {
                console.log(event.target.value)
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
              //console.log(this.poll_candidates)
            }).catch((error) => {
              console.error(error)
            })
        }
    }
</script>
