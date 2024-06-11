 async function fetchCatWeights() {
  try {
    const response = await fetch('functions/get_weights.php');
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    console.log('Fetched data:', data); 
    return data;
  } catch (error) {
    console.error('Error fetching cat weights:', error);
    return [];
  }
}

function createChart(cats) {
  const ctx = document.getElementById('catWeightsChart').getContext('2d');
  const datasets = [];

  Object.keys(cats).forEach(catName => {
    const cat = cats[catName];
    datasets.push({
      label: catName,
      backgroundColor: cat.color,
      borderColor: cat.color,
      data: cat.weights.map(w => ({
        x: new Date(w.date),
        y: w.weight
      })),
      fill: false
    });
  });

  console.log('Datasets:', datasets);

  new Chart(ctx, {
    type: 'line',
    data: {
      datasets: datasets
    },
    options: {
      scales: {
        x: {
          type: 'time',
          time: {
            unit: 'day'
          },
          title: {
            display: true,
            text: 'Date'
          }
        },
        y: {
          title: {
            display: true,
            text: 'Weight (grams)'
          }
        }
      }
    }
  });
}

async function init() {
  const data = await fetchCatWeights();

  const cats = {};
  data.forEach(item => {
    if (!cats[item.cat_name]) {
      cats[item.cat_name] = {
        color: item.cat_color,
        weights: []
      };
    }
    cats[item.cat_name].weights.push({
      date: item.date_tracked,
      weight: item.weight
    });
  });

  

  console.log('Processed data:', cats); 

  createChart(cats);
}

window.onload = init;