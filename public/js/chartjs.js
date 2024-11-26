var ctx = document.getElementById('animalViewsChart');
var apiUrl = ctx.dataset.url ?? null

let propsType = [{
        names: [],
        viewCounts: []
    }
]

// Appel l'api pour récupérer les données
if (ctx) {
    fetch(apiUrl)
        .then(response => {
            if(response.status === 200){
                return response.json();
            }
            // si codeStatus différent de 200, création un chartJs vide
            createChartJs()
        })
        .then(data => {
            createChartJs(data)
        })
}

function createChartJs(data = propsType) {
    var chart = new Chart(ctx.getContext('2d'), {
        type: 'bar',
        data: {
            labels: data[0].names,
            datasets: [{
                label: 'Nombre de vues',
                data: data[0].viewCounts,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}


