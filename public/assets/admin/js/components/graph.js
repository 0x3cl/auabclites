import { get_visitors, get_referrers } from "./data.js";

export function site_visitor_graph() {

// Initialize arrays for month and count data
let selected_year;
let month = [];
let count = [];
let datasets = [];

// Retrieve visitor data asynchronously
get_visitors()
  .then((response) => {
    // Get the selected year
    selected_year = new Date().getFullYear();

    // Check if the response status is 200 and the message is 'ok'
    if (response.status === 200 && response.message === 'ok') {
      for(let key in response.data) {
        const data = {
          label: `${key} VISITORS`,
          data: Object.values(response.data[key]),
          backgroundColor: '#801313',
          borderColor: '#801313',
          borderWidth: 1
        }
        datasets.push(data);
      }

      // Extract data for the selected year
      const data = response.data[selected_year];

      // Populate month and count arrays using the data
      month.push(...Object.keys(data));
      count.push(...Object.values(data));
    }
  })
  .then(() => {
    // Select the canvas element by its ID
    const ctx = $('canvas#site-visitor');

    
    // Create a Chart.js chart
    const chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: month,
        datasets: datasets
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });
}

export function site_referrer_graph() {

  let referrer = []; 
  let count = [];

  get_referrers().then((response) => {
    console.log(response);
      if (response.status === 200 && response.message === 'ok') {
        referrer.push(...Object.keys(response.data));
        for(let key in response.data) {
          count.push(response.data[key].count);
        }
      }
  }).then(() => {
    const ctx = $('canvas#site-referrer ');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: referrer,
          datasets: [{
            label: 'Site Referrers',
            data: count,
            backgroundColor:  '#801313',
            hoverOffset: 4
          }]
        },
        options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true
              }
            }
        }
    }) 
});
}
