cookieElement = document.getElementById("myChart");
var config = {type: 'bar', data: {datasets: [{data: [10, 20, 30], backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"], label: 'Dataset 1'}], labels: ['Red', 'Blue', 'Yellow']}, options: {responsive: true}};


var myChart = new Chart(cookieElement, config);
