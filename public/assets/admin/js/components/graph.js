export function site_visitor_graph() {
    const ctx = $('canvas#site-visitor');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
              label: 'Total Visitors',
              data: [12, 19, 3, 5, 2, 3],
              backgroundColor: 'rgba(54, 162, 235, 0.5)',
              borderColor: 'rgba(54, 162, 235, 1)', 
              borderWidth: 1 
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
}

export function site_referrersocmed_graph() {
  const ctx = $('canvas#site-referrer-socmed ');
  const chart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: [
          'Facebook',
          'Twitter',
          'Instagram'
        ],
        datasets: [{
          label: 'Social Media',
          data: [300, 50, 100],
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
          ],
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
}

export function site_referrersothers_graph() {
  const ctx = $('canvas#site-referrer-others ');
  const chart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: [
          'Google',
          'Linkedin',
          'Others'
        ],
        datasets: [{
          label: 'Social Media',
          data: [20, 50, 130],
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
          ],
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
}